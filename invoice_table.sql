-- Tabel untuk menyimpan invoice
CREATE TABLE invoices (
  id SERIAL PRIMARY KEY,
  invoice_number VARCHAR(50) UNIQUE NOT NULL,
  customer_name VARCHAR(255) NOT NULL,
  customer_phone VARCHAR(50),
  customer_address TEXT,
  items JSONB NOT NULL,
  subtotal DECIMAL(12,2) NOT NULL,
  discount DECIMAL(12,2) DEFAULT 0,
  tax DECIMAL(12,2) DEFAULT 0,
  total DECIMAL(12,2) NOT NULL,
  payment_status VARCHAR(20) DEFAULT 'pending',
  payment_method VARCHAR(50),
  notes TEXT,
  created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
  updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Index untuk query lebih cepat
CREATE INDEX idx_invoices_created_at ON invoices(created_at DESC);
CREATE INDEX idx_invoices_payment_status ON invoices(payment_status);
CREATE INDEX idx_invoices_invoice_number ON invoices(invoice_number);

-- Trigger untuk update updated_at otomatis
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ language 'plpgsql';

CREATE TRIGGER update_invoices_updated_at BEFORE UPDATE
ON invoices FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- Contoh struktur JSONB untuk items:
-- [
--   {
--     "name": "Velvet Red Matte",
--     "quantity": 2,
--     "price": 89000,
--     "subtotal": 178000
--   }
-- ]

-- Contoh payment_status: 'pending', 'paid', 'cancelled'
