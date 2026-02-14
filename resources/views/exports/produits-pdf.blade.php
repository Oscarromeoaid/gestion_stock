{{-- resources/views/exports/produits-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #f3f4f6;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .stock-bas {
            color: #dc2626;
            font-weight: bold;
        }
        .stock-ok {
            color: #16a34a;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
        .info-box {
            background-color: #eff6ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📦 LISTE DES PRODUITS</h1>
        <p>Généré le {{ $date }}</p>
    </div>

    <div class="info-box">
        <strong>Nombre total de produits :</strong> {{ $produits->count() }}<br>
        <strong>Valeur totale du stock :</strong> {{ number_format($totalValeur, 2) }} €
    </div>

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Fournisseur</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Valeur</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->sku }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->categorie->nom }}</td>
                    <td>{{ $produit->fournisseur->nom }}</td>
                    <td>{{ number_format($produit->prix, 2) }} €</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ number_format($produit->valeurStock(), 2) }} €</td>
                    <td class="{{ $produit->isStockBas() ? 'stock-bas' : 'stock-ok' }}">
                        {{ $produit->isStockBas() ? '⚠ Stock Bas' : '✓ OK' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Valeur totale : {{ number_format($totalValeur, 2) }} €
    </div>
</body>
</html>