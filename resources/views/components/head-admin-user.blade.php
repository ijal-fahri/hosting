<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Daftar User</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan di <head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .filter-btn.btn-primary {
            border: none;
        }

        .filter-btn:not(.btn-primary) {
            background-color: #e0e0e0;
            color: #333;
        }
    </style>
    <script>
        function filterRows(role) {
            document.querySelectorAll('.user-row').forEach(function(row) {
                if (role === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.classList.contains(role) ? '' : 'none';
                }
            });
        }

        document.querySelectorAll('.filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const role = this.dataset.filter;
                filterRows(role);
            });
        });

        // Tampilkan data staff saat pertama kali halaman load
        document.addEventListener('DOMContentLoaded', function() {
            filterRows('staff');
        });
    </script>

</head>
