<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeacherSubject
 * 
 * @property int $idTeacherSubject
 * @property int $idTeacher
 * @property int $idSubject
 * @property int|null $active
 * 
 * @property SubjectCourse $subject_course
 * @property User $user
 *
 * @package App\Models
 */
class TeacherSubject extends Model
{
	protected $table = 'teacher_subject';
	protected $primaryKey = 'idTeacherSubject';
	public $timestamps = false;

	protected $casts = [
		'idTeacher' => 'int',
		'idSubject' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idTeacher',
		'idSubject',
		'active'
	];

	public function subject_course()
	{
		return $this->belongsTo(SubjectCourse::class, 'idSubject');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idTeacher');
	}
}
