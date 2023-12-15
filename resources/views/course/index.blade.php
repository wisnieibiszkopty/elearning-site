@extends('main')

@section('title', 'Your courses')

@section('main')
    <!-- Table is wrong solution -->
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>Name</th>
                <th>Job</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="/tailwind-css-component-profile-2@56w.png" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Hart Hagerty</div>
                            <div class="text-sm opacity-50">United States</div>
                        </div>
                    </div>
                </td>
                <td>
                    Zemlak, Daniel and Leannon
                    <br/>
                    <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                </td>
                <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                </th>
            </tr>
            <!-- row 2 -->
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="/tailwind-css-component-profile-3@56w.png" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Brice Swyre</div>
                            <div class="text-sm opacity-50">China</div>
                        </div>
                    </div>
                </td>
                <td>
                    Carroll Group
                    <br/>
                    <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                </td>
                <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                </th>
            </tr>
            <!-- row 3 -->
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="/tailwind-css-component-profile-4@56w.png" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Marjy Ferencz</div>
                            <div class="text-sm opacity-50">Russia</div>
                        </div>
                    </div>
                </td>
                <td>
                    Rowe-Schoen
                    <br/>
                    <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                </td>
                <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                </th>
            </tr>
            <!-- row 4 -->
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="/tailwind-css-component-profile-5@56w.png" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">Yancy Tear</div>
                            <div class="text-sm opacity-50">Brazil</div>
                        </div>
                    </div>
                </td>
                <td>
                    Wyman-Ledner
                    <br/>
                    <span class="badge badge-ghost badge-sm">Community Outreach Specialist</span>
                </td>
                <th>
                    <button class="btn btn-ghost btn-xs">details</button>
                </th>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
