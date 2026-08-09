<div class="pagination">
    <?php foreach ($links as $link) : ?>
        <a href="{{ $link['url'] }}" class="{{ $link['class'] }}">{{ $link['title'] }}</a>
    <?php endforeach; ?>
</div>