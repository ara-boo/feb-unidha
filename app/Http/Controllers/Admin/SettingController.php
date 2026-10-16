<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private const TEXT_FIELDS = [
        'site_name', 'site_tagline', 'hero_title', 'hero_subtitle',
        'contact_email', 'contact_phone', 'contact_address',
        'instagram_url', 'facebook_url', 'youtube_url', 'pmb_url',
    ];

    public function edit()
    {
        return view('admin.setting.edit', ['values' => Setting::allValues()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name'       => ['required', 'string', 'max:100'],
            'site_tagline'    => ['nullable', 'string', 'max:150'],
            'hero_title'      => ['nullable', 'string', 'max:150'],
            'hero_subtitle'   => ['nullable', 'string', 'max:400'],
            'contact_email'   => ['nullable', 'email', 'max:150'],
            'contact_phone'   => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string', 'max:300'],
            'instagram_url'   => ['nullable', 'url', 'max:255'],
            'facebook_url'    => ['nullable', 'url', 'max:255'],
            'youtube_url'     => ['nullable', 'url', 'max:255'],
            'pmb_url'         => ['nullable', 'url', 'max:255'],
            'logo'            => ['nullable', 'image', 'max:2048'],
        ]);

        foreach (self::TEXT_FIELDS as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $data[$key] ?? null]);
        }

        $currentLogo = Setting::allValues()['logo'] ?? null;

        if ($request->hasFile('logo')) {
            if ($currentLogo) {
                Storage::disk('public')->delete($currentLogo);
            }
            $path = $request->file('logo')->store('branding', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        } elseif ($request->boolean('remove_logo') && $currentLogo) {
            Storage::disk('public')->delete($currentLogo);
            Setting::updateOrCreate(['key' => 'logo'], ['value' => null]);
        }

        Setting::flush();

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}