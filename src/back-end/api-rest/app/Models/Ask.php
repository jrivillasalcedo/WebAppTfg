<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ask
 * 
 * @property int $idAsk
 * @property int $idTopic
 * @property int $idClass
 * @property int $idStudent
 * @property string $askContent
 * @property int|null $answered
 * @property string|null $answer
 * @property int|null $active
 * 
 * @property Classrom $classrom
 * @property Topic $topic
 * @property User $user
 *
 * @package App\Models
 */
class Ask extends Model
{
	protected $table = 'ask';
	protected $primaryKey = 'idAsk';
	public $timestamps = false;

	protected $casts = [
		'idTopic' => 'int',
		'idClass' => 'int',
		'idStudent' => 'int',
		'answered' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idTopic',
		'idClass',
		'idStudent',
		'askContent',
		'answered',
		'answer',
		'active'
	];

	public function classrom()
	{
		return $this->belongsTo(Classrom::class, 'idClass');
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'idTopic');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idStudent');
	}
}
