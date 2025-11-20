@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16">
  <h1 class="text-3xl font-bold mb-6">Explore 3D</h1>
  <p class="text-slate-600 mb-6">This is a placeholder for the 3D explorer. You can integrate <code>three.js</code> or <code>&lt;model-viewer&gt;</code> here.</p>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl p-6 shadow-sm">
      <div class="h-40 bg-slate-100 rounded-md mb-4 flex items-center justify-center">3D preview</div>
      <h3 class="font-semibold">Monument A</h3>
      <p class="text-sm text-slate-500">Short description</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm">
      <div class="h-40 bg-slate-100 rounded-md mb-4 flex items-center justify-center">3D preview</div>
      <h3 class="font-semibold">Monument B</h3>
      <p class="text-sm text-slate-500">Short description</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm">
      <div class="h-40 bg-slate-100 rounded-md mb-4 flex items-center justify-center">3D preview</div>
      <h3 class="font-semibold">Monument C</h3>
      <p class="text-sm text-slate-500">Short description</p>
    </div>
  </div>
</div>
@endsection
