/* eslint-disable prettier/prettier */
import { IsNotEmpty, IsOptional, IsString, IsInt, Min } from 'class-validator';
import { Type } from 'class-transformer';

export class CreateTaskDto {
  @IsNotEmpty()
  @IsString()
  name: string;

  @IsOptional()
  @IsString()
  description?: string;

  @Type(() => Number)
  @IsInt({ message: 'userId must be an integer' })
  @Min(1, { message: 'userId must be a positive integer' })
  userId: number;
}
