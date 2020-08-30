<?php
namespace Grutto\News\Repositories;

interface TagRepositoryInterface  extends MariaDBRepositoryInterface  {


    /**
     * @param array $tags
     * @return mixed
     */
    public function getTagsIdsByNames(array $tags);
}
