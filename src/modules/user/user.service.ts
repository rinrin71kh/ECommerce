import { Injectable, NotFoundException } from '@nestjs/common';
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
    return await this.usersRepo.save(user);
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
