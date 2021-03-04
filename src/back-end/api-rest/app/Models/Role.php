<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $idRole
 * @property string $roleName
 * @property string|null $roleDescription
 * @property int|null $active
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'role';
	protected $primaryKey = 'idRole';
	public $timestamps = false;

	protected $casts = [
		'active' => 'int'
	];

	protected $fillable = [
		'roleName',
		'roleDescription',
		'active'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'idRole');
	}
}
