/* eslint-disable prettier/prettier */
import { Module } from '@nestjs/common';
import { AttendanceResolver } from './attendant.resolver';

@Module({
  imports: [],
  controllers: [],
  providers: [AttendanceResolver],
})
export class AttendanceModule {}
