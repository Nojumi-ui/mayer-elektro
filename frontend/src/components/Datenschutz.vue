<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Header - Mit Abstand für die fixe Navbar -->
    <div class="bg-white dark:bg-gray-800 shadow-sm pt-24">
      <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Datenschutzerklärung</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Stand: Juli 2025</p>
          </div>
          <router-link 
            to="/" 
            class="inline-flex items-center px-4 py-2 bg-[#0097b2] text-white rounded-lg hover:bg-cyan-600 transition"
          >
            <svg class="w-5 h-5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="hidden sm:inline">Zur Startseite</span>
          </router-link>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-6 py-12">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-8">
          <!-- Einleitung -->
          <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
              Datenschutz bei Mayer Elektro
            </h2>
            
            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
              <p class="mb-4">Der Schutz Ihrer persönlichen Daten ist uns ein wichtiges Anliegen. In dieser Datenschutzerklärung informieren wir Sie über die Verarbeitung Ihrer personenbezogenen Daten auf unserer Webseite gemäß der Datenschutz-Grundverordnung (DSGVO).</p>
            </div>
          </section>

          <!-- Datenschutzinformationen -->
          <section class="mb-8 border-t border-gray-200 dark:border-gray-700 pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              Datenschutzinformationen
            </h2>
            
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
              <!-- 1. Verantwortlicher -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">1. Verantwortlicher</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Verantwortlich für die Datenverarbeitung auf dieser Website ist:</p>
                  <p class="font-medium">Mayer Elektro- und Gebäudetechnik GmbH<br>
                  Christoph-Probst-Weg 4<br>
                  20251 Hamburg<br>
                  Deutschland</p>
                  <p>E-Mail: info@mayerelektro.de<br>
                  Telefon: +49 (0) 40 123 456 789</p>
                </div>
              </div>
              
              <!-- 2. Grundsätzliches zur Datenverarbeitung -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">2. Grundsätzliches zur Datenverarbeitung</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Wir verarbeiten personenbezogene Daten unserer Nutzer grundsätzlich nur, soweit dies zur Bereitstellung einer funktionsfähigen Website sowie unserer Inhalte und Leistungen erforderlich ist. Die Verarbeitung personenbezogener Daten unserer Nutzer erfolgt regelmäßig nur nach Einwilligung des Nutzers oder soweit eine gesetzliche Erlaubnis vorliegt.</p>
                  <p>Wir weisen ausdrücklich darauf hin, dass wir <strong>keine Datenbank</strong> zur Speicherung von Kundendaten betreiben. Daten, die über unsere Formulare eingegeben werden, werden direkt per E-Mail an uns weitergeleitet und nicht auf unseren Servern gespeichert.</p>
                </div>
              </div>
              
              <!-- 3. Besuch unserer Website -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">3. Besuch unserer Website</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Beim Aufrufen unserer Website werden durch den auf Ihrem Endgerät zum Einsatz kommenden Browser automatisch Informationen an den Server unserer Website gesendet. Diese Informationen werden temporär in einem sogenannten Logfile gespeichert. Folgende Informationen werden dabei ohne Ihr Zutun erfasst und bis zur automatisierten Löschung gespeichert:</p>
                  <ul>
                    <li>IP-Adresse des anfragenden Rechners</li>
                    <li>Datum und Uhrzeit des Zugriffs</li>
                    <li>Name und URL der abgerufenen Datei</li>
                    <li>Website, von der aus der Zugriff erfolgt (Referrer-URL)</li>
                    <li>Verwendeter Browser und ggf. das Betriebssystem Ihres Rechners</li>
                  </ul>
                  <p>Die genannten Daten werden durch uns zu folgenden Zwecken verarbeitet:</p>
                  <ul>
                    <li>Gewährleistung eines reibungslosen Verbindungsaufbaus der Website</li>
                    <li>Gewährleistung einer komfortablen Nutzung unserer Website</li>
                    <li>Auswertung der Systemsicherheit und -stabilität</li>
                  </ul>
                  <p>Die Rechtsgrundlage für die Datenverarbeitung ist Art. 6 Abs. 1 S. 1 lit. f DSGVO. Unser berechtigtes Interesse folgt aus oben aufgelisteten Zwecken zur Datenerhebung.</p>
                </div>
              </div>
              
              <!-- 4. Kontaktformular und E-Mail-Kontakt -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">4. Kontaktformular und E-Mail-Kontakt</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Wenn Sie uns per Kontaktformular oder E-Mail kontaktieren, werden die von Ihnen mitgeteilten Daten (Ihre E-Mail-Adresse, ggf. Ihr Name und Ihre Telefonnummer sowie weitere von Ihnen angegebene Informationen) von uns gespeichert, um Ihre Fragen zu beantworten.</p>
                  <p><strong>Wichtiger Hinweis:</strong> Die über das Kontaktformular eingegebenen Daten werden nicht in einer Datenbank gespeichert, sondern direkt per E-Mail an uns weitergeleitet. Wir speichern diese Daten nur im Rahmen der E-Mail-Kommunikation und löschen sie, sobald sie für den Zweck ihrer Erhebung nicht mehr erforderlich sind.</p>
                  <p>Die Verarbeitung dieser Daten erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO, sofern Ihre Anfrage mit der Erfüllung eines Vertrags zusammenhängt oder zur Durchführung vorvertraglicher Maßnahmen erforderlich ist. In allen übrigen Fällen beruht die Verarbeitung auf unserem berechtigten Interesse an der effektiven Bearbeitung der an uns gerichteten Anfragen (Art. 6 Abs. 1 lit. f DSGVO) oder auf Ihrer Einwilligung (Art. 6 Abs. 1 lit. a DSGVO).</p>
                </div>
              </div>
              
              <!-- 5. Bewerbungsformular -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">5. Bewerbungsformular</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Wenn Sie unser Bewerbungsformular nutzen, werden die von Ihnen angegebenen personenbezogenen Daten (wie Name, Kontaktdaten, Qualifikationen, etc.) von uns zum Zweck der Durchführung des Bewerbungsverfahrens verarbeitet.</p>
                  <p><strong>Wichtiger Hinweis:</strong> Auch die über das Bewerbungsformular eingegebenen Daten werden nicht in einer Datenbank gespeichert, sondern direkt per E-Mail an unsere Personalabteilung weitergeleitet. Die Daten werden ausschließlich für das Bewerbungsverfahren verwendet und nach Abschluss des Verfahrens gelöscht, sofern keine gesetzlichen Aufbewahrungspflichten bestehen oder Sie einer längeren Speicherung zugestimmt haben.</p>
                  <p>Die Rechtsgrundlage für die Verarbeitung Ihrer Bewerbungsdaten ist primär § 26 BDSG in Verbindung mit Art. 88 DSGVO. Danach ist die Verarbeitung der Daten zulässig, die im Zusammenhang mit der Entscheidung über die Begründung eines Beschäftigungsverhältnisses erforderlich sind.</p>
                </div>
              </div>
              
              <!-- 6. Keine Newsletter-Funktion -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">6. Keine Newsletter-Funktion</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Wir bieten auf unserer Website keinen Newsletter-Service an. Es werden daher keine E-Mail-Adressen oder andere personenbezogene Daten für Newsletterzwecke erhoben oder gespeichert.</p>
                </div>
              </div>
              
              <!-- 7. Cookies und Analysetools -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">7. Cookies und Analysetools</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Unsere Website verwendet nur technisch notwendige Cookies, die für den Betrieb der Website erforderlich sind. Diese Cookies speichern keine personenbezogenen Daten und werden nach dem Schließen Ihres Browsers gelöscht (Session-Cookies).</p>
                  <p>Wir verzichten bewusst auf den Einsatz von Tracking- oder Analysetools wie Google Analytics, um Ihre Privatsphäre zu schützen.</p>
                </div>
              </div>
              
              <!-- 8. Ihre Rechte -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">8. Ihre Rechte</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Sie haben gegenüber uns folgende Rechte hinsichtlich der Sie betreffenden personenbezogenen Daten:</p>
                  <ul>
                    <li>Recht auf Auskunft (Art. 15 DSGVO)</li>
                    <li>Recht auf Berichtigung oder Löschung (Art. 16, 17 DSGVO)</li>
                    <li>Recht auf Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
                    <li>Recht auf Widerspruch gegen die Verarbeitung (Art. 21 DSGVO)</li>
                    <li>Recht auf Datenübertragbarkeit (Art. 20 DSGVO)</li>
                  </ul>
                  <p>Sie haben zudem das Recht, sich bei einer Datenschutz-Aufsichtsbehörde über die Verarbeitung Ihrer personenbezogenen Daten durch uns zu beschweren.</p>
                </div>
              </div>
              
              <!-- 9. Änderung der Datenschutzerklärung -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">9. Änderung der Datenschutzerklärung</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>Wir behalten uns vor, diese Datenschutzerklärung anzupassen, damit sie stets den aktuellen rechtlichen Anforderungen entspricht oder um Änderungen unserer Leistungen in der Datenschutzerklärung umzusetzen, z.B. bei der Einführung neuer Services. Für Ihren erneuten Besuch gilt dann die neue Datenschutzerklärung.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Kontakt -->
          <section class="border-t border-gray-200 dark:border-gray-700 pt-8">
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Fragen zum Datenschutz?</h3>
              <p class="text-gray-700 dark:text-gray-300 mb-4">Wenn Sie Fragen zum Datenschutz haben, kontaktieren Sie uns gerne. Wir stehen Ihnen für weitere Informationen zur Verfügung.</p>
              <div class="flex flex-col sm:flex-row gap-4">
                <router-link 
                  to="/#contact"
                  class="flex-1 bg-[#0097b2] text-white py-3 px-6 rounded-lg hover:bg-cyan-600 transition text-center font-semibold"
                >
                  Kontakt aufnehmen
                </router-link>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Keine Übersetzungen nötig, da der Text direkt eingebettet ist
</script>