<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentRegistered
 * 
 * @property int $idStudentRegistered
 * @property int $idStudent
 * @property int $idSubject
 * @property int|null $active
 * 
 * @property User $user
 * @property SubjectCourse $subject_course
 *
 * @package App\Models
 */
class StudentRegistered extends Model
{
	protected $table = 'student_registered';
	protected $primaryKey = 'idStudentRegistered';
	public $timestamps = false;

	protected $casts = [
		'idStudent' => 'int',
		'idSubject' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idStudent',
		'idSubject',
		'active'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idStudent');
	}

	public function subject_course()
	{
		return $this->belongsTo(SubjectCourse::class, 'idSubject');
	}
}
