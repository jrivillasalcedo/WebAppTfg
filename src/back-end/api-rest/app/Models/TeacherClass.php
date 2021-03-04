<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeacherClass
 * 
 * @property int $idTeacherClass
 * @property int $idTeacher
 * @property int $idClass
 * @property int|null $active
 * 
 * @property Class $class
 * @property User $user
 *
 * @package App\Models
 */
class TeacherClass extends Model
{
	protected $table = 'teacher_class';
	protected $primaryKey = 'idTeacherClass';
	public $timestamps = false;

	protected $casts = [
		'idTeacher' => 'int',
		'idClass' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idTeacher',
		'idClass',
		'active'
	];

	public function class()
	{
		return $this->belongsTo(Class::class, 'idClass');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idTeacher');
	}
}
