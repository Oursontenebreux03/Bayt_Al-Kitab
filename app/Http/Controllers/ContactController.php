<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Log the contact message
        Log::info('Nouveau message de contact', [
            'from' => $validated['email'],
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'subject' => $validated['subject'],
            'message' => $validated['message']
        ]);

        // Envoyer un email de confirmation au client
        try {
            Mail::raw("Bonjour {$validated['first_name']},\n\nNous avons bien reçu votre message et nous vous répondrons dans les plus brefs délais.\n\nCordialement,\nL'équipe Bayt Al-Kitab", function($message) use ($validated) {
                $message->to($validated['email'])
                        ->subject('Confirmation de votre message - Bayt Al-Kitab');
            });
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de confirmation', [
                'error' => $e->getMessage(),
                'email' => $validated['email']
            ]);
        }

        // Envoyer une notification à l'administrateur
        try {
            Mail::raw("Nouveau message de contact reçu :\n\nNom: {$validated['first_name']} {$validated['last_name']}\nEmail: {$validated['email']}\nTéléphone: {$validated['phone']}\nSujet: {$validated['subject']}\n\nMessage:\n{$validated['message']}", function($message) use ($validated) {
                $message->to('admin@bayt-al-kitab.fr')
                        ->subject('Nouveau message de contact - ' . $validated['subject']);
            });
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de la notification admin', [
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
} 