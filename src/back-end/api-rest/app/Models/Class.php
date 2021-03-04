<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Class
 * 
 * @property int $idClass
 * @property int $idSubjectCourse
 * @property int $idTopic
 * @property int $idTeacherCreator
 * @property int $idGroup
 * @property string $accessCode
 * @property int $classState
 * @property int|null $active
 * 
 * @property Group $group
 * @property SubjectCourse $subject_course
 * @property User $user
 * @property Topic $topic
 * @property Collection|Ask[] $asks
 * @property Collection|StudentClass[] $student_classes
 * @property Collection|TeacherClass[] $teacher_classes
 *
 * @package App\Models
 */
class Class extends Model
{
	protected $table = 'class';
	protected $primaryKey = 'idClass';
	public $timestamps = false;

	protected $casts = [
		'idSubjectCourse' => 'int',
		'idTopic' => 'int',
		'idTeacherCreator' => 'int',
		'idGroup' => 'int',
		'classState' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idSubjectCourse',
		'idTopic',
		'idTeacherCreator',
		'idGroup',
		'accessCode',
		'classState',
		'active'
	];

	public function group()
	{
		return $this->belongsTo(Group::class, 'idGroup');
	}

	public function subject_course()
	{
		return $this->belongsTo(SubjectCourse::class, 'idSubjectCourse');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idTeacherCreator');
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'idTopic');
	}

	public function asks()
	{
		return $this->hasMany(Ask::class, 'idClass');
	}

	public function student_classes()
	{
		return $this->hasMany(StudentClass::class, 'idClass');
	}

	public function teacher_classes()
	{
		return $this->hasMany(TeacherClass::class, 'idClass');
	}
}
