@extends('layouts.app')

@section('title', 'À propos - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">À propos de Bayt Al-Kitab</h1>
            
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 text-islamic-green">Notre mission</h2>
                <p class="text-lg text-gray-700 mb-6">
                    Bayt Al-Kitab, qui signifie "La Maison du Livre" en arabe, est née d'une passion pour la transmission 
                    du savoir islamique et d'un désir de faciliter l'accès à une littérature de qualité pour tous.
                </p>
                <p class="text-gray-700 mb-6">
                    Notre librairie islamique francophone se donne pour mission de proposer une sélection rigoureuse 
                    de livres qui respectent les valeurs de l'islam tout en répondant aux besoins de la communauté musulmane 
                    francophone et de tous ceux qui souhaitent découvrir cette tradition spirituelle.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 text-islamic-green">📚 Notre sélection</h3>
                    <p class="text-gray-700">
                        Nous sélectionnons avec soin chaque livre que nous proposons, en privilégiant la qualité du contenu, 
                        la fiabilité des sources et la pédagogie. Notre catalogue couvre tous les aspects de la vie musulmane 
                        : Coran et Tafsir, apprentissage de l'arabe, sciences religieuses, spiritualité, et littérature jeunesse.
                    </p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 text-islamic-green">🎯 Notre public</h3>
                    <p class="text-gray-700">
                        Notre librairie s'adresse à tous : musulmans pratiquants, convertis, débutants dans l'apprentissage, 
                        parents souhaitant éduquer leurs enfants, et tous ceux qui s'intéressent à la culture islamique 
                        dans un esprit d'ouverture et de respect.
                    </p>
                </div>
            </div>

            <div class="bg-islamic-light rounded-lg p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 text-islamic-green">Nos valeurs</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-4xl mb-4">✅</div>
                        <h3 class="font-semibold mb-2">Authenticité</h3>
                        <p class="text-gray-700 text-sm">Nous privilégions les sources authentiques et les références reconnues</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">🌍</div>
                        <h3 class="font-semibold mb-2">Accessibilité</h3>
                        <p class="text-gray-700 text-sm">Nous rendons le savoir islamique accessible à tous, partout</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">📖</div>
                        <h3 class="font-semibold mb-2">Pédagogie</h3>
                        <p class="text-gray-700 text-sm">Nous favorisons l'apprentissage progressif et adapté</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6 text-islamic-green">Notre équipe</h2>
                <p class="text-gray-700 mb-6">
                    Notre équipe est composée de passionnés de littérature islamique, de spécialistes en sciences religieuses 
                    et de professionnels du commerce en ligne. Nous sommes là pour vous accompagner dans vos choix 
                    et répondre à toutes vos questions.
                </p>
                <p class="text-gray-700">
                    N'hésitez pas à nous contacter pour toute demande particulière ou pour des conseils personnalisés 
                    dans la sélection de vos lectures.
                </p>
            </div>
        </div>
    </div>
@endsection 