@php
    // Inputs: $image, $alt (optional), $class (optional img classes), $placeholder (optional placeholder classes)
    $alt = $alt ?? '';
    $class = $class ?? 'w-full h-48 object-cover';
    $placeholder = $placeholder ?? 'w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400';
    $img = $image ?? '';
    $imgSrc = null;

    if (preg_match('/^https?:\\/\\//i', $img)) {
        $imgSrc = $img;
    } else {
        $candidate = storage_path('app/public/' . ltrim($img, '/'));
        if ($img && file_exists($candidate)) {
            $imgSrc = asset('storage/' . ltrim($img, '/'));
        }

        if (!$imgSrc) {
            $publicCandidate = public_path(ltrim($img, '/'));
            if ($img && file_exists($publicCandidate)) {
                $imgSrc = asset('/' . ltrim($img, '/'));
            }
        }

        if (!$imgSrc && $img) {
            $pub2 = public_path('images/' . basename($img));
            if (file_exists($pub2)) {
                $imgSrc = asset('images/' . basename($img));
            }
        }
    }
@endphp

@if($imgSrc)
    <img src="{{ $imgSrc }}" alt="{{ $alt }}" class="{{ $class }}">
@else
    <div class="{{ $placeholder }}">No Image</div>
@endif
