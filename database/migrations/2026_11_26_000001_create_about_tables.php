<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();
            $table->string('hero_titre');
            $table->text('hero_texte');
            $table->string('histoire_titre');
            $table->text('histoire_texte');
            $table->string('histoire_image')->nullable();
            $table->text('mission_texte');
            $table->text('vision_texte');
            $table->string('cta_titre');
            $table->text('cta_texte');
            $table->timestamps();
        });

        Schema::create('about_values', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });

        // Contenu de départ : les textes actuels de la page
        DB::table('about_contents')->insert([
            'hero_titre' => "Nous construisons des systèmes IA qui comptent.",
            'hero_texte' => "LLABB TECH GROUP est une agence basée à Abidjan qui conçoit des solutions digitales, IT et d'intelligence artificielle pour des entreprises qui veulent avancer plus vite.",
            'histoire_titre' => "Une conviction simple : la technologie comme levier de croissance",
            'histoire_texte' => "LLABB TECH GROUP est né d'une conviction simple : la technologie doit être un levier concret de croissance, et non un simple effet de mode. L'équipe fondatrice réunit des profils venus du développement, de l'intelligence artificielle et du marketing, autour d'une même exigence — livrer des solutions qui produisent des résultats mesurables.\n"
                . "Depuis ses débuts, l'entreprise a fait le choix de l'excellence opérationnelle : chaque projet est pensé comme une réponse sur-mesure aux réalités et aux ambitions du client, plutôt que comme une solution standardisée appliquée telle quelle.",
            'histoire_image' => null,
            'mission_texte' => "Rendre la technologie accessible et rentable pour toute entreprise, à travers des solutions digitales, des outils d'IA et des stratégies marketing qui génèrent un impact concret.",
            'vision_texte' => "Devenir une référence du numérique et de l'intelligence artificielle en Afrique de l'Ouest, reconnue pour la qualité de ses réalisations et la confiance durable qu'elle construit.",
            'cta_titre' => "Prêt à accélérer votre transformation digitale ?",
            'cta_texte' => "Échangeons sur vos enjeux IA, web ou IT pour bâtir une solution adaptée à votre croissance.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $values = [
            ['Innovation', "Nous explorons en continu les technologies émergentes — IA, automatisation, données — pour proposer des solutions à la pointe plutôt que suivre la tendance."],
            ['Excellence', "Chaque livrable répond à des standards élevés de qualité, de performance et de sécurité, du premier prototype à la mise en production."],
            ['Transparence', "Une relation client fondée sur l'écoute, des points d'étape réguliers et un suivi rigoureux, sans zones d'ombre sur l'avancement du projet."],
            ['Agilité', "Des méthodes de travail qui s'adaptent aux besoins évolutifs de chaque client, du cadrage initial jusqu'à la mise en ligne."],
            ['Impact', "Nous mesurons notre réussite à la valeur concrète que nos solutions apportent — visibilité, efficacité, croissance."],
        ];

        foreach ($values as $i => [$nom, $description]) {
            DB::table('about_values')->insert([
                'nom' => $nom,
                'description' => $description,
                'ordre' => $i + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('about_values');
        Schema::dropIfExists('about_contents');
    }
};