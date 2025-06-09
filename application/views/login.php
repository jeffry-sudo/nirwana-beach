<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NirwanaParking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Font keluarga tambahan (opsional) */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="<?php echo base_url(); ?>assets/img/LogoMahada.png" alt="Logo NirwanaPark" class="mx-auto rounded-full">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">NirwanaParking</h1>
            <p class="text-sm text-gray-500">Selamat Datang, Silakan Login</p>
        </div>

        <!-- Alert jika password salah -->
        <?php if (isset($_SESSION['login_error'])): ?>
            <script>
                alert("<?= $_SESSION['login_error']; ?>");
            </script>
            <?php unset($_SESSION['login_error']); // Hapus pesan setelah ditampilkan ?>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="login/cekuser" method="POST">
            <!-- Input Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600 mb-2">Username</label>
                <input type="text" id="username" name="username" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800">
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800">
            </div>

            <!-- Tombol Login -->
            <div class="mt-6">
                <button type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Login
                </button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">Belum punya akun? <a href="#register" class="text-blue-500 hover:underline">Daftar</a></p>
        </div>
    </div>
</body>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php echo "<script>".$this->session->flashdata('message')."</script>"?>

</html>

