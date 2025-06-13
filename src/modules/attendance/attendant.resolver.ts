/* eslint-disable prettier/prettier */
import { Args, Mutation, Query, Resolver } from '@nestjs/graphql';

enum AttendanceStatus {
  P = 'P',    // Present
  AP = 'AP',  // Approved Permission
  L = 'L',    // Late
  A = 'A',    // Absent
}

interface Attendance {
  id: number;
  session: string;
  status: AttendanceStatus;
  student_id: number;
  marker: string;
}

interface Student {
  id: number;
  name: string;
  idCard: string;
  class: string;
}

@Resolver('Attendance')
export class AttendanceResolver {
  private attendances: Attendance[] = [
    // Sample attendance
    { id: 1, session: '2025-06-13', status: AttendanceStatus.P, student_id: 1, marker: 'Teacher A' },
    { id: 2, session: '2025-06-14', status: AttendanceStatus.L, student_id: 2, marker: 'Teacher B' },
    { id: 3, session: '2025-06-14', status: AttendanceStatus.A, student_id: 3, marker: 'Teacher C' },
  ];

  private students: Student[] = [
    { id: 1, name: 'Vannak', idCard: 'ID001', class: 'IT41' },
    { id: 2, name: 'Sokha', idCard: 'ID002', class: 'IT41' },
    { id: 3, name: 'Dara', idCard: 'ID003', class: 'IT42' },
  ];

  // Mark student's attendance
  @Mutation('markAttendance')
  markAttendance(
    @Args('session') session: string,
    @Args('status') status: AttendanceStatus,
    @Args('student_id') student_id: number,
    @Args('marker') marker: string,
  ) {
    const sorted = [...this.attendances].sort((a, b) => a.id - b.id);
    const lastId = sorted.length > 0 ? sorted[sorted.length - 1].id : 0;
    const attendance: Attendance = {
      id: lastId + 1,
      session,
      status,
      student_id,
      marker,
    };
    this.attendances.push(attendance);
    return attendance;
  }

  // Count attendance by class name
  @Query('countAttendanceByClass')
  countAttendanceByClass(
    @Args('class') className: string,
    @Args('status', { type: () => String, nullable: true }) status?: AttendanceStatus,
  ) {
    const studentIds = this.students.filter(s => s.class === className).map(s => s.id);
    let filtered = this.attendances.filter(a => studentIds.includes(a.student_id));
    if (status) {
      filtered = filtered.filter(a => a.status === status);
    }
    return filtered.length;
  }


  // Remove attendance
  @Mutation('removeAttendance')
  removeAttendance(@Args('id') id: number) {
    const numericId = Number(id); // Convert to number!
    const idx = this.attendances.findIndex(a => a.id === numericId);
    if (idx === -1) return false;
    this.attendances.splice(idx, 1);
    return true;
  }


  // Count attendance by student's ID
  @Query('countAttendanceByStudent')
  countAttendanceByStudent(
    @Args('student_id') student_id: number,
    @Args('status', { type: () => String, nullable: true }) status?: AttendanceStatus,
  ) {
    let filtered = this.attendances.filter(a => a.student_id === student_id);
    if (status) {
      filtered = filtered.filter(a => a.status === status);
    }
    return filtered.length;
  }

}
