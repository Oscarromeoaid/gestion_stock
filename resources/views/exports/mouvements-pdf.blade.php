{{-- resources/views/exports/mouvements-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historique Mouvements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .stats {
            background-color: #f3f4f6;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #374151;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        td {
            padding: 6px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .entree {
            color: #16a34a;
            font-weight: bold;
        }
        .sortie {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 HISTORIQUE DES MOUVEMENTS DE STOCK</h1>
        <p>Généré le {{ $date }}</p>
    </div>

    <div class="stats">
        <strong>Total de mouvements :</strong> {{ $statistiques['total'] }}<br>
        <strong>Entrées totales :</strong> <span class="entree">+{{ $statistiques['entrees'] }} unités</span><br>
        <strong>Sorties totales :</strong> <span class="sortie">-{{ $statistiques['sorties'] }} unités</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Produit</th>
                <th>SKU</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Motif</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mouvements as $mouvement)
                <tr>
                    <td>{{ $mouvement->date_mouvement->format('d/m/Y H:i') }}</td>
                    <td>{{ $mouvement->produit->nom }}</td>
                    <td>{{ $mouvement->produit->sku }}</td>
                    <td class="{{ $mouvement->type === 'entree' ? 'entree' : 'sortie' }}">
                        {{ $mouvement->type === 'entree' ? '↑ Entrée' : '↓ Sortie' }}
                    </td>
                    <td>{{ $mouvement->quantite }}</td>
                    <td>{{ Str::limit($mouvement->motif, 40) ?: '-' }}</td>
                    <td>{{ $mouvement->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>