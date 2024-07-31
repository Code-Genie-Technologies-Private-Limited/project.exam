<?php

namespace App\Documents;

use App\Models\Blog;

class BlogDocument extends Document
{
    /**
     * The view that will be used to layout the document.
     * This will be the name of the blade file.
     *
     * @var string
     */
    public $view = 'documents.blog-details';

    /**
     * The title of the document.
     *
     * @var string
     */
    public $title = 'Blog Details';

    /**
     * Name of the file.
     *
     * @var string
     */
    public $filename = 'blog-details';

    /**
     * The subject model.
     *
     * @var Blog
     */
    public $blog;

    /**
     * Constructor method.
     *
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        parent::__construct();

        $this->blog = $blog;
    }

    /**
     * Load and prepare the data.
     *
     * @return Blog
     */
    public function prepare()
    {
        return $this->loadData();
    }

    /**
     * Load the necessary data for the document.
     *
     * @return Blog
     */
    protected function loadData()
    {
        return $this->blog->load(['creator']);
    }
}
