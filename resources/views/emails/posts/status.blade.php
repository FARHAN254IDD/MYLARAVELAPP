@component('mail::message')
# Post Status Update

Hello {{ $post->user->name }},

Your post titled **"{{ $post->title }}"** has been **{{ $post->status }}** by the Admin.

@if($post->status == 'approved')
@component('mail::button', ['url' => url('/blog/'.$post->id)])
View Post
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
