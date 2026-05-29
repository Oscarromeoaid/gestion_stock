<?php
// database/seeders/ProduitSeeder.php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $produits = [
            // INFORMATIQUE (Catégorie 2)
            ['nom' => 'Ordinateur Portable Dell XPS 15', 'sku' => 'DELL-XPS-15-001', 'description' => 'Ordinateur portable haute performance', 'prix' => 1299.99, 'quantite' => 15, 'seuil_alerte' => 5, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Ordinateur Portable HP Pavilion', 'sku' => 'HP-PAV-002', 'description' => 'Ordinateur portable polyvalent', 'prix' => 699.99, 'quantite' => 20, 'seuil_alerte' => 5, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'MacBook Air M2', 'sku' => 'APPLE-MBA-003', 'description' => 'Ultrabook Apple Silicon', 'prix' => 1299.00, 'quantite' => 8, 'seuil_alerte' => 3, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'PC Fixe Dell OptiPlex', 'sku' => 'DELL-OPT-004', 'description' => 'PC de bureau professionnel', 'prix' => 899.99, 'quantite' => 12, 'seuil_alerte' => 4, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Souris Logitech MX Master 3', 'sku' => 'LOG-MX3-005', 'description' => 'Souris ergonomique sans fil', 'prix' => 99.99, 'quantite' => 50, 'seuil_alerte' => 10, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Clavier Mécanique Logitech', 'sku' => 'LOG-KB-006', 'description' => 'Clavier mécanique rétroéclairé', 'prix' => 129.99, 'quantite' => 35, 'seuil_alerte' => 10, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Webcam Logitech C920', 'sku' => 'LOG-C920-007', 'description' => 'Webcam HD 1080p', 'prix' => 79.99, 'quantite' => 25, 'seuil_alerte' => 8, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Hub USB-C 7 ports', 'sku' => 'HUB-USBC-008', 'description' => 'Hub multiports USB-C', 'prix' => 49.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Disque Dur Externe 2To', 'sku' => 'HDD-EXT-009', 'description' => 'Disque dur portable USB 3.0', 'prix' => 79.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 2, 'fournisseur_id' => 3],
            ['nom' => 'SSD Samsung 1To', 'sku' => 'SSD-SAM-010', 'description' => 'SSD interne NVMe', 'prix' => 119.99, 'quantite' => 45, 'seuil_alerte' => 10, 'categorie_id' => 2, 'fournisseur_id' => 3],

            // ÉLECTRONIQUE (Catégorie 1)
            ['nom' => 'Écran LG 27 pouces 4K', 'sku' => 'LG-27-4K-011', 'description' => 'Moniteur LED 27 pouces UHD', 'prix' => 449.99, 'quantite' => 3, 'seuil_alerte' => 5, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Écran Samsung 24 pouces', 'sku' => 'SAM-24-012', 'description' => 'Moniteur Full HD', 'prix' => 189.99, 'quantite' => 18, 'seuil_alerte' => 5, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Station d\'accueil USB-C', 'sku' => 'DOCK-USBC-013', 'description' => 'Station avec double écran', 'prix' => 249.99, 'quantite' => 10, 'seuil_alerte' => 3, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Multiprise Parasurtenseur', 'sku' => 'MULT-PARA-014', 'description' => 'Multiprise protection 8 prises', 'prix' => 34.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Câble HDMI 2m', 'sku' => 'HDMI-2M-015', 'description' => 'Câble HDMI 2.0', 'prix' => 12.99, 'quantite' => 100, 'seuil_alerte' => 20, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Adaptateur USB-C vers HDMI', 'sku' => 'ADP-USBC-016', 'description' => 'Adaptateur vidéo', 'prix' => 24.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Rallonge électrique 5m', 'sku' => 'RALL-5M-017', 'description' => 'Rallonge 16A', 'prix' => 19.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 1, 'fournisseur_id' => 2],

            // TÉLÉPHONIE (Catégorie 3)
            ['nom' => 'iPhone 15 Pro 256Go', 'sku' => 'APPL-IP15-018', 'description' => 'Smartphone Apple dernière génération', 'prix' => 1229.00, 'quantite' => 5, 'seuil_alerte' => 2, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Samsung Galaxy S24', 'sku' => 'SAM-S24-019', 'description' => 'Smartphone Android haut de gamme', 'prix' => 899.00, 'quantite' => 8, 'seuil_alerte' => 3, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'iPad Air 256Go', 'sku' => 'APPL-IPAD-020', 'description' => 'Tablette Apple 10.9 pouces', 'prix' => 749.00, 'quantite' => 6, 'seuil_alerte' => 2, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Chargeur USB-C 20W', 'sku' => 'CHAR-20W-021', 'description' => 'Chargeur rapide USB-C', 'prix' => 19.99, 'quantite' => 80, 'seuil_alerte' => 20, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Câble Lightning 1m', 'sku' => 'LIGHT-1M-022', 'description' => 'Câble Apple certifié', 'prix' => 24.99, 'quantite' => 70, 'seuil_alerte' => 15, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Coque iPhone 15', 'sku' => 'COQ-IP15-023', 'description' => 'Coque protection transparente', 'prix' => 14.99, 'quantite' => 50, 'seuil_alerte' => 10, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Protection écran iPhone', 'sku' => 'PROT-IP-024', 'description' => 'Verre trempé 9H', 'prix' => 9.99, 'quantite' => 100, 'seuil_alerte' => 20, 'categorie_id' => 3, 'fournisseur_id' => 4],

            // AUDIO & VIDÉO (Catégorie 4)
            ['nom' => 'Casque Sony WH-1000XM5', 'sku' => 'SONY-WH5-025', 'description' => 'Casque à réduction de bruit', 'prix' => 399.99, 'quantite' => 12, 'seuil_alerte' => 4, 'categorie_id' => 4, 'fournisseur_id' => 2],
            ['nom' => 'AirPods Pro 2', 'sku' => 'APPL-APP2-026', 'description' => 'Écouteurs sans fil Apple', 'prix' => 279.00, 'quantite' => 15, 'seuil_alerte' => 5, 'categorie_id' => 4, 'fournisseur_id' => 4],
            ['nom' => 'Enceinte Bluetooth JBL', 'sku' => 'JBL-ENC-027', 'description' => 'Enceinte portable waterproof', 'prix' => 129.99, 'quantite' => 20, 'seuil_alerte' => 6, 'categorie_id' => 4, 'fournisseur_id' => 2],
            ['nom' => 'Microphone USB Blue Yeti', 'sku' => 'BLUE-YETI-028', 'description' => 'Micro studio USB', 'prix' => 149.99, 'quantite' => 10, 'seuil_alerte' => 3, 'categorie_id' => 4, 'fournisseur_id' => 1],

            // RÉSEAUX (Catégorie 5)
            ['nom' => 'Routeur WiFi 6 TP-Link', 'sku' => 'TPL-RT6-029', 'description' => 'Routeur Gigabit WiFi 6', 'prix' => 89.99, 'quantite' => 15, 'seuil_alerte' => 5, 'categorie_id' => 5, 'fournisseur_id' => 3],
            ['nom' => 'Switch Gigabit 8 ports', 'sku' => 'SW-8P-030', 'description' => 'Switch non manageable', 'prix' => 39.99, 'quantite' => 25, 'seuil_alerte' => 8, 'categorie_id' => 5, 'fournisseur_id' => 3],
            ['nom' => 'Câble Ethernet Cat6 5m', 'sku' => 'ETH-5M-031', 'description' => 'Câble réseau RJ45', 'prix' => 8.99, 'quantite' => 150, 'seuil_alerte' => 30, 'categorie_id' => 5, 'fournisseur_id' => 3],
            ['nom' => 'Point d\'accès WiFi', 'sku' => 'AP-WIFI-032', 'description' => 'Access Point PoE', 'prix' => 119.99, 'quantite' => 12, 'seuil_alerte' => 4, 'categorie_id' => 5, 'fournisseur_id' => 3],

            // MOBILIER (Catégorie 6)
            ['nom' => 'Chaise de Bureau Ergonomique', 'sku' => 'CHAIR-ERG-033', 'description' => 'Chaise avec support lombaire', 'prix' => 299.99, 'quantite' => 8, 'seuil_alerte' => 3, 'categorie_id' => 6, 'fournisseur_id' => 5],
            ['nom' => 'Bureau Assis-Debout', 'sku' => 'DESK-AD-034', 'description' => 'Bureau réglable électrique', 'prix' => 549.99, 'quantite' => 4, 'seuil_alerte' => 2, 'categorie_id' => 6, 'fournisseur_id' => 7],
            ['nom' => 'Caisson mobile 3 tiroirs', 'sku' => 'CAISS-3T-035', 'description' => 'Caisson de bureau roulant', 'prix' => 89.99, 'quantite' => 15, 'seuil_alerte' => 5, 'categorie_id' => 6, 'fournisseur_id' => 7],
            ['nom' => 'Armoire métallique', 'sku' => 'ARM-MET-036', 'description' => 'Armoire 2 portes', 'prix' => 249.99, 'quantite' => 6, 'seuil_alerte' => 2, 'categorie_id' => 6, 'fournisseur_id' => 7],
            ['nom' => 'Table de réunion 6 places', 'sku' => 'TAB-REU-037', 'description' => 'Table ovale 180x90cm', 'prix' => 399.99, 'quantite' => 3, 'seuil_alerte' => 1, 'categorie_id' => 6, 'fournisseur_id' => 7],
            ['nom' => 'Lampe de bureau LED', 'sku' => 'LAMP-LED-038', 'description' => 'Lampe orientable 3 intensités', 'prix' => 39.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 6, 'fournisseur_id' => 5],

            // FOURNITURES (Catégorie 7)
            ['nom' => 'Stylo Bille Bleu (Boîte 50)', 'sku' => 'STYLO-B50-039', 'description' => 'Stylos bille pointe moyenne', 'prix' => 12.99, 'quantite' => 80, 'seuil_alerte' => 20, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Surligneurs 4 couleurs', 'sku' => 'SURL-4C-040', 'description' => 'Pack de 4 surligneurs', 'prix' => 4.99, 'quantite' => 100, 'seuil_alerte' => 25, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Post-it 76x76mm (Pack 12)', 'sku' => 'POST-12-041', 'description' => 'Notes adhésives jaunes', 'prix' => 8.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Agrafeuse Bureau', 'sku' => 'AGRA-BUR-042', 'description' => 'Agrafeuse 30 feuilles', 'prix' => 9.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Perforateur 2 trous', 'sku' => 'PERF-2T-043', 'description' => 'Perforateur 25 feuilles', 'prix' => 12.99, 'quantite' => 35, 'seuil_alerte' => 10, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Ciseaux Bureau', 'sku' => 'CIS-BUR-044', 'description' => 'Ciseaux 21cm acier inox', 'prix' => 5.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Cutter professionnel', 'sku' => 'CUTT-PRO-045', 'description' => 'Cutter lame rétractable', 'prix' => 6.99, 'quantite' => 45, 'seuil_alerte' => 12, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Règle métallique 30cm', 'sku' => 'REG-30-046', 'description' => 'Règle en aluminium', 'prix' => 3.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 7, 'fournisseur_id' => 6],

            // PAPETERIE (Catégorie 8)
            ['nom' => 'Ramette Papier A4 (Paquet 5)', 'sku' => 'PAPER-A4-047', 'description' => '5x500 feuilles A4 80g', 'prix' => 22.99, 'quantite' => 200, 'seuil_alerte' => 50, 'categorie_id' => 8, 'fournisseur_id' => 6],
            ['nom' => 'Cahier A4 Grands Carreaux', 'sku' => 'CAH-A4-048', 'description' => 'Cahier 192 pages', 'prix' => 3.99, 'quantite' => 80, 'seuil_alerte' => 20, 'categorie_id' => 8, 'fournisseur_id' => 6],
            ['nom' => 'Classeur A4 Dos Large', 'sku' => 'CLASS-A4-049', 'description' => 'Classeur 2 anneaux 80mm', 'prix' => 4.99, 'quantite' => 70, 'seuil_alerte' => 18, 'categorie_id' => 8, 'fournisseur_id' => 6],
            ['nom' => 'Pochettes Plastique A4 (100)', 'sku' => 'POCH-100-050', 'description' => 'Pochettes perforées transparentes', 'prix' => 7.99, 'quantite' => 90, 'seuil_alerte' => 22, 'categorie_id' => 8, 'fournisseur_id' => 6],
            ['nom' => 'Intercalaires A4 12 positions', 'sku' => 'INT-12-051', 'description' => 'Intercalaires en carton', 'prix' => 2.99, 'quantite' => 100, 'seuil_alerte' => 25, 'categorie_id' => 8, 'fournisseur_id' => 6],
            ['nom' => 'Étiquettes Blanches (Boîte)', 'sku' => 'ETIQ-BL-052', 'description' => 'Étiquettes adhésives 70x36mm', 'prix' => 9.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 8, 'fournisseur_id' => 6],

            // IMPRESSION (Catégorie 9)
            ['nom' => 'Imprimante Laser HP LaserJet', 'sku' => 'HP-LASER-053', 'description' => 'Imprimante laser monochrome', 'prix' => 199.99, 'quantite' => 8, 'seuil_alerte' => 3, 'categorie_id' => 9, 'fournisseur_id' => 1],
            ['nom' => 'Cartouche HP 305XL Noir', 'sku' => 'HP-305X-054', 'description' => 'Cartouche jet d\'encre HP', 'prix' => 34.99, 'quantite' => 25, 'seuil_alerte' => 8, 'categorie_id' => 9, 'fournisseur_id' => 1],
            ['nom' => 'Cartouche HP 305 Couleur', 'sku' => 'HP-305C-055', 'description' => 'Cartouche tricolore', 'prix' => 32.99, 'quantite' => 20, 'seuil_alerte' => 6, 'categorie_id' => 9, 'fournisseur_id' => 1],
            ['nom' => 'Toner HP LaserJet', 'sku' => 'HP-TONER-056', 'description' => 'Toner noir capacité standard', 'prix' => 69.99, 'quantite' => 15, 'seuil_alerte' => 5, 'categorie_id' => 9, 'fournisseur_id' => 1],
            ['nom' => 'Scanner portable', 'sku' => 'SCAN-PORT-057', 'description' => 'Scanner A4 couleur', 'prix' => 149.99, 'quantite' => 5, 'seuil_alerte' => 2, 'categorie_id' => 9, 'fournisseur_id' => 1],

            // ALIMENTAIRE (Catégorie 10)
            ['nom' => 'Café en Grains 1kg', 'sku' => 'CAFE-GR-058', 'description' => 'Café arabica torréfié', 'prix' => 18.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 10, 'fournisseur_id' => 8],
            ['nom' => 'Thé Assortiment (100 sachets)', 'sku' => 'THE-100-059', 'description' => 'Assortiment thés et infusions', 'prix' => 12.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 10, 'fournisseur_id' => 8],
            ['nom' => 'Sucre en Morceaux 1kg', 'sku' => 'SUCR-1KG-060', 'description' => 'Sucre blanc en morceaux', 'prix' => 2.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 10, 'fournisseur_id' => 8],
            ['nom' => 'Chocolat en Poudre 800g', 'sku' => 'CHOC-800-061', 'description' => 'Cacao en poudre instantané', 'prix' => 8.99, 'quantite' => 25, 'seuil_alerte' => 6, 'categorie_id' => 10, 'fournisseur_id' => 8],
            ['nom' => 'Biscuits Assortis (Boîte)', 'sku' => 'BISC-ASS-062', 'description' => 'Assortiment biscuits 1kg', 'prix' => 9.99, 'quantite' => 35, 'seuil_alerte' => 10, 'categorie_id' => 10, 'fournisseur_id' => 8],

            // BOISSONS (Catégorie 11)
            ['nom' => 'Eau Minérale 1,5L (Pack 6)', 'sku' => 'EAU-6P-063', 'description' => 'Eau plate bouteilles', 'prix' => 3.99, 'quantite' => 100, 'seuil_alerte' => 25, 'categorie_id' => 11, 'fournisseur_id' => 9],
            ['nom' => 'Café Dosettes (Pack 50)', 'sku' => 'CAFE-DOS-064', 'description' => 'Dosettes compatibles', 'prix' => 15.99, 'quantite' => 45, 'seuil_alerte' => 12, 'categorie_id' => 11, 'fournisseur_id' => 9],
            ['nom' => 'Jus d\'Orange 1L (Pack 6)', 'sku' => 'JUS-OR-065', 'description' => 'Jus d\'orange pur fruit', 'prix' => 8.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 11, 'fournisseur_id' => 9],
            ['nom' => 'Soda Cola (Pack 24)', 'sku' => 'COLA-24-066', 'description' => 'Canettes 33cl', 'prix' => 12.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 11, 'fournisseur_id' => 9],

            // SNACKS (Catégorie 12)
            ['nom' => 'Barres Chocolatées (Boîte 32)', 'sku' => 'BAR-32-067', 'description' => 'Assortiment barres chocolat', 'prix' => 19.99, 'quantite' => 25, 'seuil_alerte' => 6, 'categorie_id' => 12, 'fournisseur_id' => 8],
            ['nom' => 'Chips Assortis (Boîte 30)', 'sku' => 'CHIP-30-068', 'description' => 'Sachets individuels', 'prix' => 14.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 12, 'fournisseur_id' => 8],
            ['nom' => 'Fruits Secs Mélangés 500g', 'sku' => 'FRUIT-SEC-069', 'description' => 'Mélange noix et fruits', 'prix' => 9.99, 'quantite' => 20, 'seuil_alerte' => 5, 'categorie_id' => 12, 'fournisseur_id' => 8],

            // ENTRETIEN (Catégorie 13)
            ['nom' => 'Produit Nettoyant Multi-Usage', 'sku' => 'NETT-MU-070', 'description' => 'Spray 750ml', 'prix' => 4.99, 'quantite' => 80, 'seuil_alerte' => 20, 'categorie_id' => 13, 'fournisseur_id' => 10],
            ['nom' => 'Détergent Lave-Vaisselle', 'sku' => 'DET-LV-071', 'description' => 'Liquide vaisselle 1L', 'prix' => 3.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 13, 'fournisseur_id' => 10],
            ['nom' => 'Javel 2L', 'sku' => 'JAV-2L-072', 'description' => 'Eau de javel concentrée', 'prix' => 2.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 13, 'fournisseur_id' => 10],
            ['nom' => 'Éponges (Pack 10)', 'sku' => 'EPON-10-073', 'description' => 'Éponges grattantes', 'prix' => 5.99, 'quantite' => 70, 'seuil_alerte' => 18, 'categorie_id' => 13, 'fournisseur_id' => 10],
            ['nom' => 'Sacs Poubelle 50L (Rouleau 20)', 'sku' => 'SAC-50L-074', 'description' => 'Sacs poubelle noirs', 'prix' => 6.99, 'quantite' => 90, 'seuil_alerte' => 22, 'categorie_id' => 13, 'fournisseur_id' => 10],
            ['nom' => 'Balai + Pelle', 'sku' => 'BAL-PELL-075', 'description' => 'Kit balai et pelle', 'prix' => 12.99, 'quantite' => 15, 'seuil_alerte' => 4, 'categorie_id' => 13, 'fournisseur_id' => 10],
            ['nom' => 'Serpillière Microfibre', 'sku' => 'SERP-MIC-076', 'description' => 'Serpillière lavable', 'prix' => 8.99, 'quantite' => 25, 'seuil_alerte' => 6, 'categorie_id' => 13, 'fournisseur_id' => 10],

            // HYGIÈNE (Catégorie 14)
            ['nom' => 'Papier Toilette (Pack 12)', 'sku' => 'PT-12-077', 'description' => 'Papier toilette 3 plis', 'prix' => 8.99, 'quantite' => 120, 'seuil_alerte' => 30, 'categorie_id' => 14, 'fournisseur_id' => 11],
            ['nom' => 'Essuie-mains (Carton 12)', 'sku' => 'ESS-12-078', 'description' => 'Essuie-mains pliés', 'prix' => 19.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 14, 'fournisseur_id' => 11],
            ['nom' => 'Savon Liquide 5L', 'sku' => 'SAV-5L-079', 'description' => 'Savon mains bidon', 'prix' => 12.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 14, 'fournisseur_id' => 11],
            ['nom' => 'Gel Hydroalcoolique 1L', 'sku' => 'GEL-1L-080', 'description' => 'Solution hydroalcoolique', 'prix' => 9.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 14, 'fournisseur_id' => 11],
            ['nom' => 'Désodorisant WC', 'sku' => 'DESO-WC-081', 'description' => 'Bloc WC parfumé', 'prix' => 3.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 14, 'fournisseur_id' => 11],

            // VÊTEMENTS (Catégorie 15)
            ['nom' => 'Polo Entreprise Taille M', 'sku' => 'POLO-M-082', 'description' => 'Polo coton brodé logo', 'prix' => 24.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 15, 'fournisseur_id' => 7],
            ['nom' => 'Gilet Sécurité Jaune', 'sku' => 'GILET-JAU-083', 'description' => 'Gilet haute visibilité', 'prix' => 4.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 15, 'fournisseur_id' => 12],
            ['nom' => 'Casque de Chantier', 'sku' => 'CASQ-CHAN-084', 'description' => 'Casque protection blanc', 'prix' => 12.99, 'quantite' => 20, 'seuil_alerte' => 5, 'categorie_id' => 15, 'fournisseur_id' => 12],

            // OUTILLAGE (Catégorie 16)
            ['nom' => 'Perceuse-Visseuse 18V', 'sku' => 'PERC-18V-085', 'description' => 'Perceuse sans fil + batteries', 'prix' => 129.99, 'quantite' => 8, 'seuil_alerte' => 3, 'categorie_id' => 16, 'fournisseur_id' => 13],
            ['nom' => 'Coffret Tournevis (31 pcs)', 'sku' => 'TOUR-31-086', 'description' => 'Set tournevis professionnels', 'prix' => 34.99, 'quantite' => 15, 'seuil_alerte' => 4, 'categorie_id' => 16, 'fournisseur_id' => 13],
            ['nom' => 'Marteau 500g', 'sku' => 'MART-500-087', 'description' => 'Marteau menuisier', 'prix' => 14.99, 'quantite' => 20, 'seuil_alerte' => 5, 'categorie_id' => 16, 'fournisseur_id' => 13],
            ['nom' => 'Pince Multiprise', 'sku' => 'PINC-MUL-088', 'description' => 'Pince réglable 250mm', 'prix' => 12.99, 'quantite' => 18, 'seuil_alerte' => 5, 'categorie_id' => 16, 'fournisseur_id' => 13],
            ['nom' => 'Mètre Ruban 5m', 'sku' => 'METR-5M-089', 'description' => 'Mètre enrouleur magnétique', 'prix' => 8.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 16, 'fournisseur_id' => 13],

            // SÉCURITÉ (Catégorie 17)
            ['nom' => 'Extincteur 6kg ABC', 'sku' => 'EXT-6KG-090', 'description' => 'Extincteur poudre certifié', 'prix' => 49.99, 'quantite' => 15, 'seuil_alerte' => 4, 'categorie_id' => 17, 'fournisseur_id' => 12],
            ['nom' => 'Détecteur de Fumée', 'sku' => 'DET-FUM-091', 'description' => 'Détecteur NF certifié', 'prix' => 19.99, 'quantite' => 25, 'seuil_alerte' => 6, 'categorie_id' => 17, 'fournisseur_id' => 12],
            ['nom' => 'Trousse de Secours', 'sku' => 'TROU-SEC-092', 'description' => 'Trousse premiers secours complète', 'prix' => 29.99, 'quantite' => 12, 'seuil_alerte' => 3, 'categorie_id' => 17, 'fournisseur_id' => 12],
            ['nom' => 'Gants Nitrile (Boîte 100)', 'sku' => 'GANT-NIT-093', 'description' => 'Gants jetables taille M', 'prix' => 9.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 17, 'fournisseur_id' => 12],
            ['nom' => 'Masques FFP2 (Boîte 20)', 'sku' => 'MASQ-FFP2-094', 'description' => 'Masques protection respiratoire', 'prix' => 14.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 17, 'fournisseur_id' => 12],

            // DÉCORATION (Catégorie 18)
            ['nom' => 'Plante Verte d\'Intérieur', 'sku' => 'PLANT-INT-095', 'description' => 'Plante dépolluante en pot', 'prix' => 24.99, 'quantite' => 15, 'seuil_alerte' => 4, 'categorie_id' => 18, 'fournisseur_id' => 15],
            ['nom' => 'Cadre Photo A4', 'sku' => 'CADR-A4-096', 'description' => 'Cadre en bois noir', 'prix' => 9.99, 'quantite' => 25, 'seuil_alerte' => 6, 'categorie_id' => 18, 'fournisseur_id' => 15],
            ['nom' => 'Horloge Murale', 'sku' => 'HORL-MUR-097', 'description' => 'Horloge quartz 30cm', 'prix' => 19.99, 'quantite' => 12, 'seuil_alerte' => 3, 'categorie_id' => 18, 'fournisseur_id' => 15],

            // STOCKAGE (Catégorie 19)
            ['nom' => 'Bac Plastique 30L', 'sku' => 'BAC-30L-098', 'description' => 'Bac rangement avec couvercle', 'prix' => 12.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 19, 'fournisseur_id' => 14],
            ['nom' => 'Étagère Métallique 5 niveaux', 'sku' => 'ETAG-5N-099', 'description' => 'Rayonnage 180x90x40cm', 'prix' => 89.99, 'quantite' => 8, 'seuil_alerte' => 2, 'categorie_id' => 19, 'fournisseur_id' => 7],
            ['nom' => 'Boîtes Archives (Pack 10)', 'sku' => 'ARCH-10-100', 'description' => 'Boîtes carton dos 10cm', 'prix' => 14.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 19, 'fournisseur_id' => 6],
            ['nom' => 'Porte-Revues Métal', 'sku' => 'PORT-REV-101', 'description' => 'Range-revues mesh', 'prix' => 8.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 19, 'fournisseur_id' => 6],

            // EMBALLAGE (Catégorie 20)
            ['nom' => 'Cartons Déménagement (Pack 10)', 'sku' => 'CART-10-102', 'description' => 'Cartons double cannelure', 'prix' => 19.99, 'quantite' => 60, 'seuil_alerte' => 15, 'categorie_id' => 20, 'fournisseur_id' => 14],
            ['nom' => 'Ruban Adhésif (Pack 6)', 'sku' => 'RUB-6-103', 'description' => 'Scotch emballage 50mm', 'prix' => 8.99, 'quantite' => 80, 'seuil_alerte' => 20, 'categorie_id' => 20, 'fournisseur_id' => 14],
            ['nom' => 'Film Bulle 100m', 'sku' => 'BULLE-100-104', 'description' => 'Rouleau film à bulles', 'prix' => 24.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 20, 'fournisseur_id' => 14],
            ['nom' => 'Enveloppes A4 (Boîte 250)', 'sku' => 'ENV-A4-105', 'description' => 'Enveloppes blanches auto-adhésives', 'prix' => 19.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 20, 'fournisseur_id' => 14],
            ['nom' => 'Enveloppes Bulles (Pack 20)', 'sku' => 'ENV-BULL-106', 'description' => 'Pochettes matelassées', 'prix' => 14.99, 'quantite' => 50, 'seuil_alerte' => 12, 'categorie_id' => 20, 'fournisseur_id' => 14],

            // Produits supplémentaires pour atteindre 120+
            ['nom' => 'Support Ordinateur Portable', 'sku' => 'SUP-ORD-107', 'description' => 'Support réglable en aluminium', 'prix' => 29.99, 'quantite' => 22, 'seuil_alerte' => 6, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Tapis de Souris XXL', 'sku' => 'TAP-XXL-108', 'description' => 'Tapis bureau 80x40cm', 'prix' => 19.99, 'quantite' => 35, 'seuil_alerte' => 10, 'categorie_id' => 2, 'fournisseur_id' => 1],
            ['nom' => 'Casque Audio Bluetooth', 'sku' => 'CASQ-BT-109', 'description' => 'Casque sans fil pliable', 'prix' => 59.99, 'quantite' => 18, 'seuil_alerte' => 5, 'categorie_id' => 4, 'fournisseur_id' => 2],
            ['nom' => 'Support Téléphone Bureau', 'sku' => 'SUP-TEL-110', 'description' => 'Support ajustable aluminium', 'prix' => 14.99, 'quantite' => 40, 'seuil_alerte' => 10, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Batterie Externe 20000mAh', 'sku' => 'BAT-EXT-111', 'description' => 'Power bank charge rapide', 'prix' => 39.99, 'quantite' => 25, 'seuil_alerte' => 7, 'categorie_id' => 3, 'fournisseur_id' => 4],
            ['nom' => 'Clé USB 64Go (Pack 5)', 'sku' => 'USB-64-112', 'description' => 'Clés USB 3.0', 'prix' => 34.99, 'quantite' => 30, 'seuil_alerte' => 8, 'categorie_id' => 2, 'fournisseur_id' => 3],
            ['nom' => 'Adaptateur Multi-Prises Voyage', 'sku' => 'ADP-VOYAG-113', 'description' => 'Adaptateur universel USB', 'prix' => 24.99, 'quantite' => 20, 'seuil_alerte' => 5, 'categorie_id' => 1, 'fournisseur_id' => 2],
            ['nom' => 'Organisateur Bureau', 'sku' => 'ORG-BUR-114', 'description' => 'Organisateur mesh 6 compartiments', 'prix' => 16.99, 'quantite' => 28, 'seuil_alerte' => 7, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Porte-Gobelets', 'sku' => 'PORT-GOB-115', 'description' => 'Distributeur gobelets mural', 'prix' => 12.99, 'quantite' => 15, 'seuil_alerte' => 4, 'categorie_id' => 10, 'fournisseur_id' => 8],
            ['nom' => 'Tableau Blanc 60x90cm', 'sku' => 'TABL-BL-116', 'description' => 'Tableau magnétique effaçable', 'prix' => 39.99, 'quantite' => 10, 'seuil_alerte' => 3, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Marqueurs Tableau (Set 4)', 'sku' => 'MARQ-4-117', 'description' => 'Marqueurs effaçables couleurs', 'prix' => 7.99, 'quantite' => 45, 'seuil_alerte' => 12, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Calculatrice Scientifique', 'sku' => 'CALC-SCI-118', 'description' => 'Calculatrice 240 fonctions', 'prix' => 19.99, 'quantite' => 20, 'seuil_alerte' => 5, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Destructeur Documents', 'sku' => 'DEST-DOC-119', 'description' => 'Broyeur coupe croisée', 'prix' => 79.99, 'quantite' => 6, 'seuil_alerte' => 2, 'categorie_id' => 7, 'fournisseur_id' => 6],
            ['nom' => 'Panneau Affichage Liège', 'sku' => 'PAN-LIEG-120', 'description' => 'Panneau 90x60cm', 'prix' => 29.99, 'quantite' => 12, 'seuil_alerte' => 3, 'categorie_id' => 7, 'fournisseur_id' => 6],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}