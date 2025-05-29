/* eslint-disable prettier/prettier */
import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Task } from 'src/tasks/task.entity';
import { TaskService } from './task.service';
import { TasksController } from './task.controller';

@Module({
  imports: [
    TypeOrmModule.forFeature([Task]),
  ],
  providers: [TaskService],
  controllers: [TasksController],
})
export class TaskModule {}