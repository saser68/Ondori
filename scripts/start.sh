#!/usr/bin/env bash
set -e

# ---------------------------------------------------------------------------
# Ondori – Railway startup script
# 1. Wait for MySQL to be reachable
# 2. Import ONDORI.sql if the database has not been initialised yet
# 3. Run Laravel migrations (idempotent)
# 4. Cache views and start the built-in PHP server
# ---------------------------------------------------------------------------

# ── helpers ────────────────────────────────────────────────────────────────

DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-ondori}"
DB_USERNAME="${DB_USERNAME:-root}"
DB_PASSWORD="${DB_PASSWORD:-}"

MYSQL_CMD="mysql -h\"${DB_HOST}\" -P\"${DB_PORT}\" -u\"${DB_USERNAME}\" -p\"${DB_PASSWORD}\" \"${DB_DATABASE}\""

# Wait until MySQL accepts connections (up to 60 s)
echo "[start] Waiting for MySQL at ${DB_HOST}:${DB_PORT}..."
for i in $(seq 1 30); do
    if mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" --silent 2>/dev/null; then
        echo "[start] MySQL is up."
        break
    fi
    echo "[start] Attempt ${i}/30 – retrying in 2 s..."
    sleep 2
done

# ── seed from SQL dump if the DB is empty ──────────────────────────────────

# We use the presence of the `Categorias` table as the initialisation marker.
TABLE_EXISTS=$(mysql -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" \
    -e "SELECT COUNT(*) FROM information_schema.tables \
        WHERE table_schema='${DB_DATABASE}' AND table_name='Categorias';" \
    --skip-column-names 2>/dev/null || echo "0")

if [ "${TABLE_EXISTS}" = "0" ] || [ -z "${TABLE_EXISTS}" ]; then
    echo "[start] Database is empty – importing BD/ONDORI.sql..."
    mysql -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" \
        "${DB_DATABASE}" < "$(dirname "$0")/../BD/ONDORI.sql"
    echo "[start] SQL dump imported successfully."
else
    echo "[start] Database already initialised – skipping SQL import."
fi

# ── Laravel bootstrap ──────────────────────────────────────────────────────

echo "[start] Running migrations..."
php artisan migrate --force

echo "[start] Caching views..."
php artisan view:cache || echo "[start] Warning: view:cache failed (non-fatal) – continuing startup."

echo "[start] Starting server on 0.0.0.0:${PORT:-8000}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
