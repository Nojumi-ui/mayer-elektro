<?php
/**
 * Rate Limiter Klasse
 * Implementiert Rate Limiting basierend auf IP-Adressen und Session-Daten
 */

class RateLimiter {
    private $storage;
    
    public function __construct() {
        // Einfache Datei-basierte Speicherung für Rate Limiting
        $this->storage = __DIR__ . '/../storage/rate_limits.json';
        $this->ensureStorageExists();
    }
    
    private function ensureStorageExists() {
        $dir = dirname($this->storage);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        if (!file_exists($this->storage)) {
            file_put_contents($this->storage, json_encode([]));
        }
    }
    
    private function loadLimits() {
        $content = file_get_contents($this->storage);
        return json_decode($content, true) ?: [];
    }
    
    private function saveLimits($limits) {
        file_put_contents($this->storage, json_encode($limits, JSON_PRETTY_PRINT));
    }
    
    private function cleanupExpired($limits, $currentTime) {
        $cleaned = [];
        
        foreach ($limits as $ip => $ipLimits) {
            $cleanedIpLimits = [];
            
            foreach ($ipLimits as $type => $data) {
                if ($currentTime - $data['first_request'] < $data['window']) {
                    $cleanedIpLimits[$type] = $data;
                }
            }
            
            if (!empty($cleanedIpLimits)) {
                $cleaned[$ip] = $cleanedIpLimits;
            }
        }
        
        return $cleaned;
    }
    
    public function checkLimit($ip, $type, $maxRequests, $windowSeconds) {
        $limits = $this->loadLimits();
        $currentTime = time();
        
        // Abgelaufene Einträge bereinigen
        $limits = $this->cleanupExpired($limits, $currentTime);
        
        // Prüfen ob IP bereits existiert
        if (!isset($limits[$ip])) {
            $limits[$ip] = [];
        }
        
        // Prüfen ob Type bereits existiert
        if (!isset($limits[$ip][$type])) {
            return true; // Noch keine Requests für diesen Type
        }
        
        $limitData = $limits[$ip][$type];
        
        // Prüfen ob das Zeitfenster abgelaufen ist
        if ($currentTime - $limitData['first_request'] >= $windowSeconds) {
            return true; // Zeitfenster abgelaufen, Request erlaubt
        }
        
        // Prüfen ob Limit erreicht
        return $limitData['count'] < $maxRequests;
    }
    
    public function incrementLimit($ip, $type, $windowSeconds = 3600) {
        $limits = $this->loadLimits();
        $currentTime = time();
        
        // Abgelaufene Einträge bereinigen
        $limits = $this->cleanupExpired($limits, $currentTime);
        
        if (!isset($limits[$ip])) {
            $limits[$ip] = [];
        }
        
        if (!isset($limits[$ip][$type])) {
            $limits[$ip][$type] = [
                'count' => 1,
                'first_request' => $currentTime,
                'last_request' => $currentTime,
                'window' => $windowSeconds
            ];
        } else {
            // Prüfen ob das Zeitfenster abgelaufen ist
            if ($currentTime - $limits[$ip][$type]['first_request'] >= $windowSeconds) {
                // Neues Zeitfenster beginnen
                $limits[$ip][$type] = [
                    'count' => 1,
                    'first_request' => $currentTime,
                    'last_request' => $currentTime,
                    'window' => $windowSeconds
                ];
            } else {
                // Zähler erhöhen
                $limits[$ip][$type]['count']++;
                $limits[$ip][$type]['last_request'] = $currentTime;
            }
        }
        
        $this->saveLimits($limits);
    }
    
    public function getRemainingRequests($ip, $type, $maxRequests, $windowSeconds) {
        $limits = $this->loadLimits();
        $currentTime = time();
        
        if (!isset($limits[$ip][$type])) {
            return $maxRequests;
        }
        
        $limitData = $limits[$ip][$type];
        
        // Prüfen ob das Zeitfenster abgelaufen ist
        if ($currentTime - $limitData['first_request'] >= $windowSeconds) {
            return $maxRequests;
        }
        
        return max(0, $maxRequests - $limitData['count']);
    }
    
    public function getResetTime($ip, $type) {
        $limits = $this->loadLimits();
        
        if (!isset($limits[$ip][$type])) {
            return null;
        }
        
        $limitData = $limits[$ip][$type];
        return $limitData['first_request'] + $limitData['window'];
    }
    
    public function clearLimits($ip = null, $type = null) {
        if ($ip === null) {
            // Alle Limits löschen
            $this->saveLimits([]);
            return;
        }
        
        $limits = $this->loadLimits();
        
        if ($type === null) {
            // Alle Limits für eine IP löschen
            unset($limits[$ip]);
        } else {
            // Spezifischen Limit löschen
            if (isset($limits[$ip][$type])) {
                unset($limits[$ip][$type]);
                
                // Wenn keine Limits mehr für diese IP, IP-Eintrag löschen
                if (empty($limits[$ip])) {
                    unset($limits[$ip]);
                }
            }
        }
        
        $this->saveLimits($limits);
    }
    
    public function getStats($ip = null) {
        $limits = $this->loadLimits();
        $currentTime = time();
        
        if ($ip !== null) {
            return $limits[$ip] ?? [];
        }
        
        // Statistiken für alle IPs
        $stats = [
            'total_ips' => count($limits),
            'active_limits' => 0,
            'expired_limits' => 0
        ];
        
        foreach ($limits as $ipLimits) {
            foreach ($ipLimits as $limitData) {
                if ($currentTime - $limitData['first_request'] < $limitData['window']) {
                    $stats['active_limits']++;
                } else {
                    $stats['expired_limits']++;
                }
            }
        }
        
        return $stats;
    }
}