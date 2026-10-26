body {
    font-family: Arial, sans-serif;
    background: #f5f7fb;
}

.card {
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
}

.hero {
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
    color: #fff;
    border-radius: 18px;
    padding: 40px 24px;
}

.navbar-brand {
    letter-spacing: 0.04em;
}

.bus-card {
    border: 1px solid #e3e6ef;
    border-radius: 16px;
    background: white;
    padding: 20px;
}

.seat-box {
    width: 42px;
    height: 42px;
    margin: 4px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    font-size: 0.8rem;
    cursor: pointer;
}

.seat-box.available { background: #e7f7ef; color: #198754; border-color: #8ad2a7; }
.seat-box.selected { background: #0d6efd; color: white; border-color: #0d6efd; }
.seat-box.booked { background: #f8d7da; color: #b02a37; border-color: #f5c2c7; cursor: not-allowed; }
.seat-box.held { background: #fff3cd; color: #b8860b; border-color: #ffecb5; }
.seat-box.blocked { background: #e2e3e5; color: #6c757d; border-color: #d3d3d4; }

.ticket-box {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 24px;
}

.table td, .table th { vertical-align: middle; }

