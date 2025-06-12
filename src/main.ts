/* eslint-disable @typescript-eslint/no-unsafe-argument */
/* eslint-disable @typescript-eslint/no-floating-promises */
import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';
import { ValidationPipe } from '@nestjs/common';

async function bootstrap() {
  const app = await NestFactory.create(AppModule);

  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      transform: true,
    })
  );

  app.enableCors(); // <<< ADD THIS LINE

  // await app.listen(process.env.PORT ?? 3100);
  const port = process.env.PORT ? Number(process.env.PORT) : 3100;
  await app.listen(port);
  // Print the API URL and port
  console.log(`\n🚀  API is running on: http://localhost:${port}\n`);
}
bootstrap();
