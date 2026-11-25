@php
    // Transforme un texte saisi dans le Dashboard en paragraphes et en listes
    $blocks = [];
    $lastType = null;

    foreach (preg_split('/\r\n|\r|\n/', (string) ($text ?? '')) as $rawLine) {
        $line = trim($rawLine);

        // Ligne vide : on termine la liste en cours
        if ($line === '') {
            $lastType = null;
            continue;
        }

        if (preg_match('/^(?:[-–—*]\s+|•\s*)(.+)$/u', $line, $m)) {
            $type = 'ul';
            $content = $m[1];
        } elseif (preg_match('/^\d+[.)]\s+(.+)$/u', $line, $m)) {
            $type = 'ol';
            $content = $m[1];
        } else {
            $type = 'p';
            $content = $line;
        }

        if ($type !== 'p' && $lastType === $type) {
            $blocks[count($blocks) - 1]['items'][] = $content;
        } else {
            $blocks[] = ['type' => $type, 'items' => [$content]];
        }

        $lastType = $type;
    }
@endphp

@foreach ($blocks as $block)
    @if ($block['type'] === 'ul')
        <ul>
            @foreach ($block['items'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    @elseif ($block['type'] === 'ol')
        <ol>
            @foreach ($block['items'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ol>
    @else
        <p>{{ $block['items'][0] }}</p>
    @endif
@endforeach