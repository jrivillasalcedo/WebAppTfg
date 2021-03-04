<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectCourse
 * 
 * @property int $idSubjectCourse
 * @property int $idSubject
 * @property int $idCourse
 * @property string|null $obs
 * 
 * @property Course $course
 * @property Subject $subject
 * @property Collection|Class[] $classes
 * @property Collection|StudentRegistered[] $student_registereds
 * @property Collection|TeacherSubject[] $teacher_subjects
 * @property Collection|Topic[] $topics
 *
 * @package App\Models
 */
class SubjectCourse extends Model
{
	protected $table = 'subject_course';
	protected $primaryKey = 'idSubjectCourse';
	public $timestamps = false;

	protected $casts = [
		'idSubject' => 'int',
		'idCourse' => 'int'
	];

	protected $fillable = [
		'idSubject',
		'idCourse',
		'obs'
	];

	public function course()
	{
		return $this->belongsTo(Course::class, 'idCourse');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class, 'idSubject');
	}

	public function classes()
	{
		return $this->hasMany(Class::class, 'idSubjectCourse');
	}

	public function student_registereds()
	{
		return $this->hasMany(StudentRegistered::class, 'idSubject');
	}

	public function teacher_subjects()
	{
		return $this->hasMany(TeacherSubject::class, 'idSubject');
	}

	public function topics()
	{
		return $this->hasMany(Topic::class, 'idSubjectCourse');
	}
}
