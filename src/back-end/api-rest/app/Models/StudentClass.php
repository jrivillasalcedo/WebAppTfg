<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentClass
 * 
 * @property int $idStudentClass
 * @property int $idStudent
 * @property int $idClass
 * @property int $studentOnline
 * @property int $studentBaned
 * @property int|null $active
 * 
 * @property Class $class
 * @property User $user
 *
 * @package App\Models
 */
class StudentClass extends Model
{
	protected $table = 'student_class';
	protected $primaryKey = 'idStudentClass';
	public $timestamps = false;

	protected $casts = [
		'idStudent' => 'int',
		'idClass' => 'int',
		'studentOnline' => 'int',
		'studentBaned' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idStudent',
		'idClass',
		'studentOnline',
		'studentBaned',
		'active'
	];

	public function class()
	{
		return $this->belongsTo(Class::class, 'idClass');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idStudent');
	}
}
