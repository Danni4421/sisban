<nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      
      @if (isset($links) && !empty($links))
          @foreach ($links as $link)
            <li class="breadcrumb-item">
              <a href="{{ $link["href"] }}">{{ $link["label"] }}</a>
            </li>
          @endforeach
      @endif

      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
</nav>