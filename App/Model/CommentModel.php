<?php
namespace App\Model;

use Core\Database\Model;

class CommentModel extends Model
{
    private $title;
    private $message;
    private $status;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function rules()
    {
        return [
            'title' => ['type' => 'string', 'required' => 'required', 'min' => 3, 'max' => 55],
            'message' => ['type' => 'string', 'required' => 'required', 'min' => 3, 'max' => 280],
        ];
    }
}
