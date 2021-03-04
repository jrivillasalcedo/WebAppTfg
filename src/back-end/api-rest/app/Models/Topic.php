<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $idTopic
 * @property int $idSubjectCourse
 * @property string $topicName
 * @property string|null $topicDescription
 * @property int|null $active
 * 
 * @property SubjectCourse $subject_course
 * @property Collection|Ask[] $asks
 * @property Collection|Class[] $classes
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topic';
	protected $primaryKey = 'idTopic';
	public $timestamps = false;

	protected $casts = [
		'idSubjectCourse' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idSubjectCourse',
		'topicName',
		'topicDescription',
		'active'
	];

	public function subject_course()
	{
		return $this->belongsTo(SubjectCourse::class, 'idSubjectCourse');
	}

	public function asks()
	{
		return $this->hasMany(Ask::class, 'idTopic');
	}

	public function classes()
	{
		return $this->hasMany(Class::class, 'idTopic');
	}
}
