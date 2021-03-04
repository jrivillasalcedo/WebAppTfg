<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $idUser
 * @property int $idRole
 * @property string $userName
 * @property string $userSurname
 * @property string $mail
 * @property string $pass
 * @property string $dni
 * @property Carbon|null $birthDate
 * @property string $indentificationNumber
 * @property string|null $profileImage
 * @property int $loginNumber
 * @property int|null $active
 * @property string|null $remember_token
 * 
 * @property Role $role
 * @property Collection|Ask[] $asks
 * @property Collection|Classrom[] $classroms
 * @property Collection|StudentClass[] $student_classes
 * @property Collection|StudentRegistered[] $student_registereds
 * @property Collection|Subject[] $subjects
 * @property Collection|TeacherClass[] $teacher_classes
 * @property Collection|TeacherSubject[] $teacher_subjects
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'idUser';
	public $timestamps = false;

	protected $casts = [
		'idRole' => 'int',
		'loginNumber' => 'int',
		'active' => 'int'
	];

	protected $dates = [
		'birthDate'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'idRole',
		'userName',
		'userSurname',
		'mail',
		'pass',
		'dni',
		'birthDate',
		'indentificationNumber',
		'profileImage',
		'loginNumber',
		'active',
		'remember_token'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'idRole');
	}

	public function asks()
	{
		return $this->hasMany(Ask::class, 'idStudent');
	}

	public function classroms()
	{
		return $this->hasMany(Classrom::class, 'idTeacherCreator');
	}

	public function student_classes()
	{
		return $this->hasMany(StudentClass::class, 'idStudent');
	}

	public function student_registereds()
	{
		return $this->hasMany(StudentRegistered::class, 'idStudent');
	}

	public function subjects()
	{
		return $this->hasMany(Subject::class, 'idCreator');
	}

	public function teacher_classes()
	{
		return $this->hasMany(TeacherClass::class, 'idTeacher');
	}

	public function teacher_subjects()
	{
		return $this->hasMany(TeacherSubject::class, 'idTeacher');
	}
}
