{{-- resources/views/exports/inventaire-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport d'Inventaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            color: #1e40af;
            font-size: 24px;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .stat-box {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            text-align: center;
            background-color: #f3f4f6;
            border: 1px solid #ddd;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
        }
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #1e40af;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 5px;
        }
        .stock-bas {
            background-color: #fee2e2 !important;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 RAPPORT D'INVENTAIRE COMPLET</h1>
        <p>Généré le {{ $date }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-value">{{ $statistiques['total_produits'] }}</div>
            <div class="stat-label">Produits</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ number_format($statistiques['valeur_totale'], 0) }} €</div>
            <div class="stat-label">Valeur Totale</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $statistiques['stock_bas'] }}</div>
            <div class="stat-label">Alertes Stock Bas</div>
        </div>
    </div>

    <div class="section-title">Répartition par Catégorie</div>
    <table>
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Nombre de produits</th>
                <th>Valeur totale</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistiques['par_categorie'] as $cat)
                <tr>
                    <td>{{ $cat['nom'] }}</td>
                    <td>{{ $cat['count'] }}</td>
                    <td>{{ number_format($cat['valeur'], 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Détail des Produits</div>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Qté</th>
                <th>Prix Unit.</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr class="{{ $produit->isStockBas() ? 'stock-bas' : '' }}">
                    <td>{{ $produit->sku }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->categorie->nom }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ number_format($produit->prix, 2) }} €</td>
                    <td>{{ number_format($produit->valeurStock(), 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>