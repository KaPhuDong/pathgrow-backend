<?php

namespace App\Repositories;

use App\Models\ClassesManagement;

class ClassManagementRepository
{
    public function getAll()
    {
        return ClassesManagement::orderBy('id', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function find($id)
    {
        return ClassesManagement::with(['subjects', 'students', 'teachers'])->find($id);
    }


    public function create(array $data)
    {
        return ClassesManagement::create($data);
    }

    public function update($id, array $data)
    {
        $class = ClassesManagement::find($id);
        if (!$class) {
            return false;
        }

        $class->update($data);
        return true;
    }

    public function delete($id)
    {
        $class = ClassesManagement::find($id);
        if (!$class) {
            return false;
        }

        $class->delete();
        return true;
    }

    // Thêm vào ClassManagementRepository.php

    public function addSubjects($classId, array $subjectIds)
    {
        $class = ClassesManagement::find($classId);
        if (!$class) return false;

        $class->subjects()->syncWithoutDetaching($subjectIds);
        return true;
    }

    public function removeSubjects($classId, array $subjectIds)
    {
        $class = ClassesManagement::find($classId);
        if (!$class) return false;

        $class->subjects()->detach($subjectIds);
        return true;
    }

    public function addStudents($classId, array $studentIds)
    {
        return \App\Models\User::whereIn('id', $studentIds)->update(['class_id' => $classId]);
    }

    public function removeStudents(array $studentIds)
    {
        return \App\Models\User::whereIn('id', $studentIds)->where('role', 'student')->update(['class_id' => null]);
    }

    public function addTeachers($classId, array $teacherIds)
    {
        return \App\Models\User::whereIn('id', $teacherIds)->update(['class_id' => $classId]);
    }

    public function removeTeachers(array $teacherIds)
    {
        return \App\Models\User::whereIn('id', $teacherIds)->where('role', 'teacher')->update(['class_id' => null]);
    }
}
