/**
 * Gère l'identifiant unique de l'appareil
 * Stocké dans localStorage pour persister entre les sessions
 */

const DEVICE_ID_KEY = 'beyondmemories_device_id';

/**
 * Génère un UUID v4
 */
function generateUUID(): string {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    const r = Math.random() * 16 | 0;
    const v = c === 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}

/**
 * Récupère ou crée l'ID de l'appareil
 */
export function getDeviceId(): string {
  let deviceId = localStorage.getItem(DEVICE_ID_KEY);
  
  if (!deviceId) {
    deviceId = generateUUID();
    localStorage.setItem(DEVICE_ID_KEY, deviceId);
    console.log('🆔 Nouvel appareil créé:', deviceId);
  } else {
    console.log('🆔 Appareil existant:', deviceId);
  }
  
  return deviceId;
}

/**
 * Réinitialise l'ID de l'appareil (crée un nouvel océan)
 */
export function resetDeviceId(): string {
  const newDeviceId = generateUUID();
  localStorage.setItem(DEVICE_ID_KEY, newDeviceId);
  console.log('🔄 Nouvel océan créé:', newDeviceId);
  return newDeviceId;
}
