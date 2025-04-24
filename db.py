from flask import Flask, request, redirect, url_for, render_template, flash
from werkzeug.security import generate_password_hash, check_password_hash
from flask_cors import CORS
import redis, requests , ipaddress


app = Flask(__name__)
CORS(app)

app.secret_key = 'verdefast' 
Esp32="http://192.168.0.17"

# Conexión a Redis
cx = redis.Redis(host='localhost', port=6379, decode_responses=True)

@app.route('/', methods=['GET'])
def index():
    return render_template('index.html')  # Página de inicio

@app.route('/registro', methods=['GET', 'POST'])
def registro_usuario():
    if request.method == 'POST':
        # Obtener datos del formulario
        nombre = request.form['nombre']
        apellido = request.form['apellido']
        correo = request.form['correo']
        telefono = request.form['telefono']
        genero = request.form['genero']
        fecha_nacimiento = request.form['fecha_nacimiento']
        domicilio = request.form['domicilio']
        contraseña = request.form['contraseña']

        # Verificar si el correo ya existe en Redis
        if cx.exists(f"usuario:{correo}"):
            flash('El correo ya está registrado. Intenta con otro.', 'error')
            return redirect(url_for('registro_usuario'))

        # Si no existe, guardar en Redis
        cx.hset(f"usuario:{correo}", mapping={
            'nombre': nombre,
            'apellido': apellido,
            'correo': correo,
            'telefono': telefono,
            'genero': genero,
            'fecha_nacimiento': fecha_nacimiento,
            'domicilio': domicilio,
            'contraseña': generate_password_hash(contraseña),
            'rol':"cliente"
        })

        return redirect(url_for('index'))

    return render_template('registro.html')  # Formulario de registro

@app.route('/login', methods=['POST'])
def login():
    correo = request.form['correo']
    contraseña = request.form['contraseña']

    # Buscar si el usuario existe en Redis
    if cx.exists(f"usuario:{correo}"):
        usuario = cx.hgetall(f"usuario:{correo}")
        contraseña_guardada = usuario.get('contraseña')
        rol_guardado = usuario.get('rol')

        # Verificar la contraseña
        if check_password_hash(contraseña_guardada, contraseña) and rol_guardado == 'cliente':
            return redirect(url_for('panel_control'))
        else:
            flash('Contraseña incorrecta.', 'error')
            return redirect(url_for('index'))
    else:
        flash('El correo no está registrado.', 'error')
        return redirect(url_for('index'))

@app.route('/sembradio')
def panel_control():
    return render_template('/sembradio.html')  # Página del panel de control

@app.route('/exito')
def registro_exitoso():
    return redirect(url_for('index'))  # Redirige al index tras el registro

@app.route('/configuracion')
def configuracion():
    return render_template('/panel-control.html')  # Página de la configuración


estado_pulsos = "off"

@app.route("/pulsos", methods=["POST"])
def set_estadoPulsos():
    global estado_pulsos
    nuevo_estado = request.args.get("state")

    ip_cliente = request.remote_addr
    try:
        ip = ipaddress.ip_address(ip_cliente)
        if not ip.is_private:
            return "⛔ Acceso denegado: solo disponible desde red local", 403
    except ValueError:
        return "⛔ IP inválida", 400

    if nuevo_estado in ["on", "off"]:
        estado_pulsos = nuevo_estado
        try:
            url_esp32 = Esp32
            endpoint = "/activar_pulsos" if nuevo_estado == "on" else "/desactivar_pulsos"
            requests.get(f"{url_esp32}{endpoint}")
        except Exception as e:
            return f"❌ Error al contactar ESP32: {e}", 500

        return f"✅ Estado actualizado a {estado_pulsos}"

    return "❌ Estado inválido", 400



estado_riego = "off"

@app.route("/riego", methods=["POST"])
def set_estadoRiego():
    global estado_riego
    nuevo_estado = request.args.get("state")

    ip_cliente = request.remote_addr
    try:
        ip = ipaddress.ip_address(ip_cliente)
        if not ip.is_private:
            return "⛔ Acceso denegado: solo disponible desde red local", 403
    except ValueError:
        return "⛔ IP inválida", 400

    if nuevo_estado in ["on", "off"]:
        estado_riego = nuevo_estado
        try:
            url_esp32 = Esp32
            endpoint = "/activar_riego" if nuevo_estado == "on" else "/desactivar_riego"
            requests.get(f"{url_esp32}{endpoint}")
        except Exception as e:
            return f"❌ Error al contactar ESP32: {e}", 500

        return f"✅ Estado actualizado a {estado_riego}"

    return "❌ Estado inválido", 400


