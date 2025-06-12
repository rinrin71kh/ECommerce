/* eslint-disable prettier/prettier */
/* eslint-disable @typescript-eslint/no-unsafe-member-access */
/* eslint-disable @typescript-eslint/no-unsafe-call */
import { BadRequestException, Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { User } from 'src/users/user.entity';
import { Repository } from 'typeorm';

@Injectable()
export class UsersService {
  constructor(
    @InjectRepository(User)
    private usersRepo: Repository<User>
  ) {}

  async create(userData: Partial<User>) {
    const user = this.usersRepo.create(userData);
    try {
      return await this.usersRepo.save(user);
    } catch (err) {
      if (
        err.code === 'SQLITE_CONSTRAINT' ||
        err.code === '23505' // 23505 is PostgreSQL unique violation
      ) {
        throw new BadRequestException('Email already exists');
      }
      throw err; // rethrow other errors
    }
  }

  async findAll() {
    return await this.usersRepo.find({ relations: ['tasks'] });
  }

  async findOne(id: number) {
    const user = await this.usersRepo.findOne({
      where: { id },
      relations: ['tasks'],
    });
    if (!user) {
      throw new NotFoundException(`User with id ${id} not found`);
    }
    return user;
  }

  async update(id: number, updateData: Partial<User>) {
    await this.usersRepo.update(id, updateData);
    return this.findOne(id);
  }

  async remove(id: number) {
    return await this.usersRepo.delete(id);
  }
}
