<?php 
namespace App;

class Setting
{
	protected $user;
	protected $allowed = ['city','bio'];

	function __construct(User $user)
	{
		$this->user = $user;
	}

	public function merge(array $attributes)
	{
		// $casts没生效 无法直接转化成数组 USER $casts 所以用json_decode一次 bug在setting blade里无法互相转化
		$settings = array_merge($this->user->settings,array_only($attributes, $this->allowed));
		return $this->user->update(['settings' => $settings]);
	}
}

?>