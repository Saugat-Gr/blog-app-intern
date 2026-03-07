<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasAnyPermission(['create-post', 'edit-post']) || $this->user()->id === $this->route('post')->author_id;
    }

    public function rules()
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'], 
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
            'status' => ['required', 'in:' .  implode(',', array_column(PostStatus::cases(), 'value'))],
            'published_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];

        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $postId = $this->route('post')->id ?? null;
            $rules['title'][] = 'unique:posts,title,' . $postId;
        } else {
            $rules['title'][] = 'unique:posts,title';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Post title is required.',
            'title.unique' => 'A post with this title already exists.',
            'content.required' => 'Post content cannot be empty.',
            'status.in' => 'Invalid status selected.',
            'published_at.after_or_equal' => 'Published date must be today or later.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Images must be of type jpeg, png, jpg, gif, or webp.',
        ];
    }
}