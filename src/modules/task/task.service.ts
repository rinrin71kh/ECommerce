/* eslint-disable @typescript-eslint/no-unsafe-call */
/* eslint-disable @typescript-eslint/no-unsafe-member-access */
/* eslint-disable @typescript-eslint/no-unsafe-return */
/* eslint-disable prettier/prettier */
import { Injectable, NotFoundException, Inject, forwardRef } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Task } from 'src/tasks/task.entity';
import { Repository } from 'typeorm';
import { UsersService } from '../user/user.service';
import { CreateTaskDto } from './dto/create-task.dto';

@Injectable()
export class TaskService {
  constructor(
    @InjectRepository(Task)
    private tasksRepo: Repository<Task>,
    @Inject(forwardRef(() => UsersService))
    private usersService: UsersService,
  ) {}

  // Create task with validation for userId
  async create(taskData: CreateTaskDto) {
    // Check if user exists (throws NotFoundException if not)
    await this.usersService.findOne(taskData.userId);

    const task = this.tasksRepo.create(taskData);
    return await this.tasksRepo.save(task);
  }

  // Find all tasks (with related user)
  async findAll() {
    return await this.tasksRepo.find({ relations: ['user'] });
  }

  // Find one task by ID
  async findOne(id: number) {
    const task = await this.tasksRepo.findOne({ where: { id }, relations: ['user'] });
    if (!task) throw new NotFoundException(`Task with id ${id} not found`);
    return task;
  }

  // Update task by ID
  async update(id: number, updateData: Partial<Task>) {
    const result = await this.tasksRepo.update(id, updateData);
    if (result.affected === 0) throw new NotFoundException(`Task with id ${id} not found`);
    return this.findOne(id);
  }

  // Remove (delete) task by ID
  async remove(id: number) {
    const result = await this.tasksRepo.delete(id);
    if (result.affected === 0) throw new NotFoundException(`Task with id ${id} not found`);
    return { message: `Task with id ${id} deleted` };
  }

  // Clear all tasks
  async clearAll() {
    await this.tasksRepo.createQueryBuilder()
      .delete()
      .from(Task)
      .execute();
    return { message: 'All tasks cleared' };
  }
}
