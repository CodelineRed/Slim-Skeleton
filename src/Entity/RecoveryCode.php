<?php
namespace App\Entity;

use App\MappedSuperclass\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recovery_code")
 */
class RecoveryCode extends Base {

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recoveryCodes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * Encoded recovery code
     * 
     * @ORM\Column(type="string", options={"comment": "Encoded recovery code"})
     */
    private $code;

    public function __construct() {
        if (!isset($this->id)) {
            $this->setIdWithRamsey();
        }
    }

    /**
     * Set $id
     * 
     * @param string $id
     * @return RecoveryCode
     */
    private function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get $user
     * 
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set $user
     * 
     * @param User $user
     * @return RecoveryCode
     */
    public function setUser($user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get $code
     * 
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set $code
     * 
     * @param string $code
     * @return RecoveryCode
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }
}