<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 9:58 PM
 */

namespace App\Entity;


class Site
{
    private $urlName;
    private $url;
    private $category;
    private $description;

    /**
     * @return mixed
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * @param mixed $urlName
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;
    }



    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}