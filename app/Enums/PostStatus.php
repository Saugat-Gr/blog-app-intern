<?php

namespace App\Enums;

// draft,published,archived
enum PostStatus: string 
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
