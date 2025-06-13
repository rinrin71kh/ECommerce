/* eslint-disable prettier/prettier */
import { Args, Mutation, Query, Resolver } from '@nestjs/graphql';

interface Student {
  id: number;
  name: string;
  idCard: string;
  class: string;
}

@Resolver('Student')
export class StudentResolver {
  private students: Student[] = [
    {
      id: 1,
      name: 'Vannak',
      idCard: 'ID001',
      class: 'IT41',
    },
    {
      id: 2,
      name: 'Sokha',
      idCard: 'ID002',
      class: 'IT41',
    },
    {
      id: 3,
      name: 'Dara',
      idCard: 'ID003',
      class: 'IT42',
    },
  ];

  // Get students by class name
  @Query('studentsByClass')
  getStudentsByClass(@Args('class') className: string) {
    return this.students.filter((student) => student.class === className);
  }

  // Enroll student to class
  @Mutation('enrollStudent')
  enrollStudent(
    @Args('name') name: string,
    @Args('idCard') idCard: string,
    @Args('class') className: string,
  ) {
    const sorted = [...this.students].sort((a, b) => a.id - b.id);
    const lastId = sorted.length > 0 ? sorted[sorted.length - 1].id : 0;
    const newStudent: Student = {
      id: lastId + 1,
      name,
      idCard,
      class: className,
    };
    this.students.push(newStudent);
    return newStudent;
  }

  // Remove student from class (delete student)
  @Mutation('removeStudent')
  removeStudent(@Args('id') id: number) {
    const numericId = Number(id); // ensure it's a number
    const index = this.students.findIndex((student) => student.id === numericId);
    if (index === -1) {
      return false;
    }
    this.students.splice(index, 1);
    return true;
  }


  // Update student's information
  @Mutation('updateStudent')
updateStudent(
  @Args('id') id: number,
  @Args('name') name?: string,
  @Args('idCard') idCard?: string,
  @Args('class') className?: string,
) {
  const numericId = Number(id); // <-- Always convert to number
  const idx = this.students.findIndex((s) => s.id === numericId);
  if (idx === -1) throw new Error('Student not found');
  const updated: Student = {
    ...this.students[idx],
    name: name ?? this.students[idx].name,
    idCard: idCard ?? this.students[idx].idCard,
    class: className ?? this.students[idx].class,
  };
  this.students[idx] = updated;
  return updated;
}

}
