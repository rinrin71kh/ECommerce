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

interface AttendanceStatusCount {
  P: number;
  AP: number;
  L: number;
  A: number;
}

@Resolver('Attendance')
export class AttendanceResolver {
  private attendances: Attendance[] = [
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

  // List all attendances (optionally by status)
  @Query('attendances')
  getAttendances(
    @Args('status', { type: () => String, nullable: true }) status?: AttendanceStatus,
  ) {
    if (status) {
      return this.attendances.filter(a => a.status === status);
    }
    return this.attendances;
  }

  // List attendances by class (optionally by status)
  @Query('attendancesByClass')
  attendancesByClass(
    @Args('class') className: string,
    @Args('status', { type: () => String, nullable: true }) status?: AttendanceStatus,
  ) {
    const studentIds = this.students.filter(s => s.class === className).map(s => s.id);
    let filtered = this.attendances.filter(a => studentIds.includes(a.student_id));
    if (status) {
      filtered = filtered.filter(a => a.status === status);
    }
    return filtered;
  }

  // List attendances by student (optionally by status)
  @Query('attendancesByStudent')
  attendancesByStudent(
    @Args('student_id') student_id: number,
    @Args('status', { type: () => String, nullable: true }) status?: AttendanceStatus,
  ) {
    let filtered = this.attendances.filter(a => a.student_id === student_id);
    if (status) {
      filtered = filtered.filter(a => a.status === status);
    }
    return filtered;
  }

  // Count attendance by class name (optionally by status)
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

  // Count attendance by student's ID (optionally by status)
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

  // Remove attendance
  @Mutation('removeAttendance')
  removeAttendance(@Args('id') id: number) {
    const numericId = Number(id);
    const idx = this.attendances.findIndex(a => a.id === numericId);
    if (idx === -1) return false;
    this.attendances.splice(idx, 1);
    return true;
  }

  // Count attendance by student for all statuses
  @Query('countAttendanceByStudentAllStatus')
  countAttendanceByStudentAllStatus(@Args('student_id') student_id: number): AttendanceStatusCount {
    const result: AttendanceStatusCount = { P: 0, AP: 0, L: 0, A: 0 };
    this.attendances.forEach(a => {
      if (a.student_id === student_id) {
        if (result[a.status] !== undefined) {
          result[a.status]++;
        }
      }
    });
    // Always return all keys!
    return {
      P: result.P || 0,
      AP: result.AP || 0,
      L: result.L || 0,
      A: result.A || 0,
    };
  }

  // Count attendance by class for all statuses
  @Query('countAttendanceByClassAllStatus')
  countAttendanceByClassAllStatus(@Args('class') className: string): AttendanceStatusCount {
    const studentIds = this.students.filter(s => s.class === className).map(s => s.id);
    const result: AttendanceStatusCount = { P: 0, AP: 0, L: 0, A: 0 };
    this.attendances.forEach(a => {
      if (studentIds.includes(a.student_id)) {
        if (result[a.status] !== undefined) {
          result[a.status]++;
        }
      }
    });
    // Always return all keys!
    return {
      P: result.P || 0,
      AP: result.AP || 0,
      L: result.L || 0,
      A: result.A || 0,
    };
  }
}
