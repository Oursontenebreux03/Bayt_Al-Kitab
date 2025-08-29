<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
    }

    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mettre à jour les paramètres
        Setting::set('site_name', $request->site_name, 'string', 'general', 'Nom du site');
        Setting::set('site_description', $request->site_description, 'text', 'general', 'Description du site');
        Setting::set('contact_email', $request->contact_email, 'string', 'contact', 'Email de contact');
        Setting::set('contact_phone', $request->contact_phone, 'string', 'contact', 'Téléphone de contact');
        Setting::set('address', $request->address, 'text', 'contact', 'Adresse');

        // Gestion du logo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/images', $logoName);
            Setting::set('logo', 'images/' . $logoName, 'string', 'general', 'Logo du site');
        }

        session()->flash('success', 'Paramètres mis à jour avec succès !');

        return redirect()->route('admin.settings.index');
    }
} 