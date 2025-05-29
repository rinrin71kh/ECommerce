/* eslint-disable prettier/prettier */
import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { User } from 'src/users/user.entity';
import { UsersService } from './user.service';
import { UsersController } from './user.controller';

@Module({
  imports: [
    TypeOrmModule.forFeature([User]), // 👈 This is key
  ],
  providers: [UsersService],
  controllers: [UsersController],
})
export class UserModule {}