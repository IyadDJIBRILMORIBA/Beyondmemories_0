# 🚀 API Documentation - 3 Clicks to Eternity

**Base URL:** `http://localhost:8000/api`

---

## 📤 ÉTAPE 1 : Upload de fichiers

### POST `/upload`
Upload une ou plusieurs photos/vidéos.

**Body (multipart/form-data):**
```json
{
  "files[]": [File, File, ...],
  "taken_at": "2023-05-15" (optionnel)
}
```

**Response:**
```json
{
  "success": true,
  "message": "3 fichier(s) uploadé(s)",
  "memories": [
    {
      "id": 1,
      "path": "memories/xyz.jpg",
      "type": "image",
      "taken_at": "2023-05-15",
      "is_featured": false
    }
  ]
}
```

---

### GET `/memories`
Récupérer tous les souvenirs de l'utilisateur.

**Response:**
```json
{
  "success": true,
  "memories": [
    {
      "id": 1,
      "url": "http://localhost:8000/storage/memories/xyz.jpg",
      "type": "image",
      "taken_at": "2023-05-15",
      "is_featured": false
    }
  ]
}
```

---

### POST `/memories/{id}/feature`
Marquer/démarquer un souvenir comme "featured" (dans la timeline).

**Response:**
```json
{
  "success": true,
  "memory": { ... }
}
```

---

### DELETE `/memories/{id}`
Supprimer un souvenir.

**Response:**
```json
{
  "success": true,
  "message": "Souvenir supprimé avec succès"
}
```

---

## 📊 ÉTAPE 2 : Timeline

### GET `/timeline`
Récupérer uniquement les souvenirs "featured" (timeline).

**Response:**
```json
{
  "success": true,
  "timeline": [
    {
      "id": 1,
      "url": "http://localhost:8000/storage/memories/xyz.jpg",
      "type": "image",
      "taken_at": "1950-06-15"
    }
  ]
}
```

---

### POST `/generate-timeline`
Auto-générer la timeline (Mock IA) : sélectionne aléatoirement ~5 souvenirs.

**Response:**
```json
{
  "success": true,
  "message": "5 souvenirs sélectionnés pour la timeline",
  "timeline": [ ... ]
}
```

---

## 🏞️ ÉTAPE 3 : Parcelles 3D

### POST `/parcel`
Créer une nouvelle parcelle 3D.

**Body (JSON):**
```json
{
  "template_id": 1,
  "name": "Mémorial de Grand-mère" (optionnel)
}
```

**Response:**
```json
{
  "success": true,
  "message": "Parcelle créée avec succès",
  "parcel": {
    "id": 1,
    "name": "Mémorial de Grand-mère",
    "template_id": 1,
    "share_uuid": "abc123-def456-...",
    "share_url": "http://localhost:8000/parcel/abc123-def456-..."
  }
}
```

---

### GET `/parcel/{uuid}`
Voir une parcelle via son UUID (partage public).

**Response:**
```json
{
  "success": true,
  "parcel": {
    "id": 1,
    "name": "Mémorial de Grand-mère",
    "template_id": 1,
    "created_at": "29/11/2025"
  },
  "memories": [
    {
      "id": 1,
      "url": "http://localhost:8000/storage/memories/xyz.jpg",
      "type": "image",
      "taken_at": "1950-06-15"
    }
  ]
}
```

---

### GET `/parcels`
Lister toutes les parcelles (debug).

**Response:**
```json
{
  "success": true,
  "parcels": [ ... ]
}
```

---

## ✅ Health Check

### GET `/health`
Vérifier que l'API fonctionne.

**Response:**
```json
{
  "status": "ok",
  "message": "3 Clicks to Eternity API"
}
```

---

## 🔐 Authentification

**Pour le prototype:** Aucune authentification requise. Tout est associé à `user_id = 1`.

---

## 🛠️ Codes d'erreur

- `200` : Succès
- `201` : Ressource créée
- `400` : Requête invalide
- `404` : Ressource non trouvée
- `500` : Erreur serveur

---

## 📝 Notes

- **Formats acceptés:** JPG, PNG, GIF, MP4, MOV, AVI
- **Taille max:** 50 MB par fichier
- **Templates disponibles:** 1 à 5