<div class="grid-layout">
    <div class="box">
        <h3>Input Akun Baru</h3>
        <form id="bankForm">
            <div class="form-group">
                <label>Jenis Bank</label>
                <select id="jenis_bank" required>
                    <option value="">-- Pilih Bank --</option>
                    <option value="BCA">BCA</option>
                    <option value="BRI">BRI</option>
                    <option value="Mandiri">Mandiri</option>
                </select>
            </div>
            <div class="form-group">
                <label>No. Order</label>
                <input type="text" id="no_order" required>
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="text" id="grade" required>
            </div>
            <div class="form-group">
                <label>NIK</label>
                <input type="number" id="nik" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="nama" required>
            </div>
            <div class="form-group">
                <label>Nama Ibu Kandung</label>
                <input type="text" id="ibu_kandung" required>
            </div>
            <div class="form-group">
                <label>Tempat, Tanggal Lahir</label>
                <input type="text" id="tempat_tgl_lahir" placeholder="Contoh: Jakarta, 01-01-1995" required>
            </div>
            
            <button type="submit" class="btn-submit">Simpan & Kirim ke Sheet</button>
        </form>
    </div>

    <div class="box">
        <h3>Data Bank Terdaftar</h3>
        <input type="text" id="searchData" class="search-box" placeholder="🔍 Ketik Nama, NIK, atau No. Order untuk mencari...">
        
        <div class="table-responsive">
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Bank</th>
                        <th>No. Order</th>
                        <th>Grade</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Ibu Kandung</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td colspan="7" style="text-align:center; color:#888;">Memuat data dari Google Sheets...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const urlJembatan = "<?= GOOGLE_SCRIPT_URL ?>";

    // Kirim Data Baru
    document.getElementById('bankForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const dataForm = {
            jenis_bank: document.getElementById('jenis_bank').value,
            no_order: document.getElementById('no_order').value,
            grade: document.getElementById('grade').value,
            nik: document.getElementById('nik').value,
            nama: document.getElementById('nama').value,
            ibu_kandung: document.getElementById('ibu_kandung').value,
            tempat_tgl_lahir: document.getElementById('tempat_tgl_lahir').value
        };

        fetch(urlJembatan, {
            method: 'POST',
            mode: 'no-cors',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dataForm)
        })
        .then(() => {
            alert('Data berhasil disimpan ke Google Sheets!');
            document.getElementById('bankForm').reset();
            muatDataDariSheets();
        })
        .catch(err => alert('Gagal mengirim data: ' + err));
    });

    // Fitur Pencarian Real-Time
    document.getElementById('searchData').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Memuat Data Otomatis dari Google Sheet
    function muatDataDariSheets() {
        fetch(urlJembatan + "?action=read")
        .then(res => res.json())
        .then(data => {
            let html = '';
            if(data.length === 0 || data.status === "error") {
                html = `<tr><td colspan="7" style="text-align:center;">Tidak ada data ditemukan.</td></tr>`;
            } else {
                data.forEach((row, index) => {
                    if (index === 0) return; // Lewati baris header judul
                    html += `<tr>
                        <td>${index}</td>
                        <td>${row[1] || ''}</td>
                        <td>${row[2] || ''}</td>
                        <td>${row[3] || ''}</td>
                        <td>${row[4] || ''}</td>
                        <td>${row[5] || ''}</td>
                        <td>${row[6] || ''}</td>
                    </tr>`;
                });
            }
            document.getElementById('tableBody').innerHTML = html;
        })
        .catch(err => {
            document.getElementById('tableBody').innerHTML = `<tr><td colspan="7" style="text-align:center; color:red;">Gagal memuat data.</td></tr>`;
        });
    }
    
    // Jalankan penarikan data pertama kali halaman dibuka
    muatDataDariSheets();
</script>
