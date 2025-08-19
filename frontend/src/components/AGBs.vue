<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Header - Mit Abstand für die fixe Navbar -->
    <div class="bg-white dark:bg-gray-800 shadow-sm pt-24">
      <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Allgemeine Geschäftsbedingungen</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Gültig ab Juli 2025</p>
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
              Allgemeine Geschäftsbedingungen
            </h2>
            
            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
              <p class="mb-4">Nachfolgend finden Sie unsere Allgemeinen Geschäftsbedingungen. Bitte lesen Sie diese sorgfältig durch, da sie die rechtliche Grundlage für alle Geschäftsbeziehungen zwischen Ihnen und der Mayer Elektro- und Gebäudetechnik GmbH bilden.</p>
            </div>
          </section>

          <!-- Allgemeine Geschäftsbedingungen -->
          <section class="mb-8 border-t border-gray-200 dark:border-gray-700 pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              Vertragsbedingungen
            </h2>
            
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
              <!-- § 1 Geltungsbereich -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 1 Geltungsbereich</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Diese AGB gelten für alle Verträge zwischen der Mayer Elektro- und Gebäudetechnik GmbH, Christsoph-Probst-Weg 4, 20251 Hamburg und ihren Kunden. Dies umfasst Verträge mit Unternehmern sowie mit Verbrauchern, soweit anwendbar. Entgegenstehende oder abweichende Geschäftsbedingungen des Kunden finden keine Anwendung, es sei denn, Mayer Elektro- und Gebäudetechnik GmbH hat ihrer Geltung ausdrücklich zugestimmt.</p>
                  <p>(2) Begriffsdefinitionen: „Verbraucher" im Sinne dieser AGB ist jede natürliche Person, die ein Rechtsgeschäft zu einem Zweck abschließt, der überwiegend weder ihrer gewerblichen noch ihrer selbständigen beruflichen Tätigkeit zugerechnet werden kann. „Unternehmer" ist eine natürliche oder juristische Person oder rechtsfähige Personengesellschaft, die bei Abschluss des Vertrags in Ausübung ihrer gewerblichen oder selbständigen beruflichen Tätigkeit handelt.</p>
                  <p>(3) Soweit die nachstehenden Bedingungen keine abweichenden Regelungen enthalten, gelten bei Arbeiten an Bauwerken (Bauleistungen) ergänzend die Bestimmungen der Verdingungsordnung für Bauleistungen Teil B (VOB/B) in der jeweils gültigen Fassung.</p>
                  <p>(4) Leistungsspektrum: Mayer Elektro- und Gebäudetechnik GmbH erbringt insbesondere folgende Leistungen: Bauleitung, Elektroinstallation, Instandhaltung, Projektplanung, Netzwerktechnik sowie Sicherheits- und Alarmtechnik.</p>
                </div>
              </div>
              
              <!-- § 2 Vertragsschluss -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 2 Vertragsschluss</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Angebot und Bestellung: Angebote von Mayer Elektro- und Gebäudetechnik GmbH (z. B. Kostenvoranschläge, Leistungsbeschreibungen) sind freibleibend und unverbindlich, sofern nicht ausdrücklich schriftlich als bindend bezeichnet. Sie dienen der Information des Kunden und stellen keine verbindlichen Vertragsangebote dar.</p>
                  <p>(2) Branchenübliche Vertragsschlüsse: Verträge können – insbesondere im B2B-Geschäft – formlos, etwa mündlich oder per E-Mail, geschlossen werden. Auch in solchen Fällen gelten diese AGB.</p>
                  <p>(3) Elektronische Kommunikation: Soweit Verträge elektronisch (z. B. via E-Mail oder Online-Formular) angebahnt oder abgeschlossen werden, verzichtet der Kunde auf den Zugang einer Annahmeerklärung (§ 151 BGB), sofern die Vertragserfüllung unmittelbar erfolgt.</p>
                </div>
              </div>
              
              <!-- § 3 Leistungen -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 3 Leistungen, Ausführung und Termine</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Leistungserbringung: Mayer Elektro- und Gebäudetechnik GmbH erbringt die vertraglich vereinbarten Leistungen fachgerecht und nach dem aktuell anerkannten Stand der Technik sowie unter Beachtung aller einschlägigen Normen und Sicherheitsvorschriften (z. B. VDE-Vorschriften).</p>
                  <p>(2) Leistungsänderungen: Wünscht der Kunde nach Vertragsschluss Änderungen oder Erweiterungen des Leistungsumfangs, wird Mayer Elektro- und Gebäudetechnik GmbH diese – soweit zumutbar – berücksichtigen. Eventuelle Mehrkosten oder Terminverschiebungen sind vom Kunden zu tragen, sofern die Gründe in seinem Änderungswunsch liegen.</p>
                  <p>(3) Fristen und Termine: Angegebene Ausführungs- oder Lieferfristen sind, soweit nicht ausdrücklich als „verbindlich" zugesagt, unverbindlich. Die Ausführung beginnt so bald wie möglich nach Vertragsschluss oder zum individuell vereinbarten Termin.</p>
                </div>
              </div>
              
              <!-- § 4 Mitwirkungspflichten des Kunden -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 4 Mitwirkungspflichten des Kunden</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Zugang und Informationen: Der Kunde hat Mayer Elektro- und Gebäudetechnik GmbH alle zur Auftragsdurchführung erforderlichen Unterlagen, Genehmigungen und Informationen rechtzeitig und vollständig zur Verfügung zu stellen.</p>
                  <p>(2) Baustellenvorbereitung: Der Kunde sorgt dafür, dass die Arbeitsstätte zum vereinbarten Termin frei zugänglich ist und sich in einem Zustand befindet, der den vertragsgemäßen Leistungen nicht entgegensteht.</p>
                  <p>(3) Unterstützung und Sicherheit: Der Kunde trifft die üblichen Vorkehrungen zum Schutz von Personen und Eigentum am Einsatzort.</p>
                </div>
              </div>
              
              <!-- § 5 Preise und Zahlungsbedingungen -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 5 Preise, Vergütung und Zahlungsbedingungen</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Preise: Die von Mayer Elektro- und Gebäudetechnik GmbH angebotenen oder vertraglich vereinbarten Preise verstehen sich – sofern nicht anders angegeben – netto, zuzüglich der gesetzlichen Mehrwertsteuer in jeweils gültiger Höhe. Ist der Kunde Verbraucher, werden Preisangaben im Angebot als Endpreise (brutto inkl. MwSt.) ausgewiesen.</p>
                  <p>(2) Reise- und Nebenkosten: Erforderliche Anfahrten, Fahrtkosten, Spesen oder Versandkosten werden, sofern nicht ausdrücklich pauschal im Angebot eingeschlossen, zusätzlich in Rechnung gestellt.</p>
                  <p>(3) Fälligkeit: Rechnungen sind, sofern nichts Abweichendes schriftlich vereinbart wurde, sofort nach Erhalt der Rechnung ohne Abzug zur Zahlung fällig.</p>
                </div>
              </div>
              
              <!-- § 6 Eigentumsvorbehalt -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 6 Eigentumsvorbehalt</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Einfacher Eigentumsvorbehalt: Mayer Elektro- und Gebäudetechnik GmbH behält sich das Eigentum an allen gelieferten Waren, Bauteilen und sonstigen körperlichen Gegenständen (nachfolgend „Vorbehaltsware") bis zur vollständigen Bezahlung der hierfür geschuldeten Vergütung vor.</p>
                  <p>(2) Erweiterter Eigentumsvorbehalt (für Unternehmerkunden): Unternehmerkunden dürfen die Vorbehaltsware im ordnungsgemäßen Geschäftsgang weiterveräußern; eine Verpfändung oder Sicherungsübereignung ist ihnen jedoch nicht gestattet.</p>
                </div>
              </div>
              
              <!-- § 7 Ausführungszeit, Abnahme und Gefahrenübergang -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 7 Ausführungszeit, Abnahme und Gefahrenübergang</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Leistungs-/Lieferzeit und Annahmeverzug des Kunden: Gerät der Kunde mit der Annahme der Leistung oder Lieferung in Verzug (Gläubigerverzug), oder verzögert sich die Ausführung aus Gründen, die der Kunde zu vertreten hat, so geht die Gefahr des zufälligen Untergangs oder einer zufälligen Verschlechterung der Leistung in dem Zeitpunkt auf den Kunden über, in dem dieser in Verzug geraten ist.</p>
                  <p>(2) Abnahme von Werkleistungen: Sobald Mayer Elektro- und Gebäudetechnik GmbH die vertraglich geschuldete Werkleistung (z. B. die Installation oder Montage einer Anlage) fertiggestellt hat, wird sie dem Kunden die Fertigstellung mitteilen und zur Abnahme auffordern.</p>
                </div>
              </div>
              
              <!-- § 8 Gewährleistung -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 8 Gewährleistung (Mängelansprüche)</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Gesetzliche Rechte: Kunden, die Verbraucher sind, stehen die gesetzlichen Gewährleistungsrechte nach dem Bürgerlichen Gesetzbuch (BGB) zu. Diese AGB enthalten keine Beschränkung der gesetzlichen Mängelhaftungsrechte von Verbrauchern; Rechte aus eventuell gewährten Herstellergarantien bleiben unberührt.</p>
                  <p>(2) Beschaffenheit der Leistung: Grundlage für die Mängelhaftung ist die vereinbarte Beschaffenheit der Lieferung oder Leistung.</p>
                  <p>(3) Nacherfüllung: Liegt ein Mangel der gelieferten Ware oder der Werkleistung vor, kann der Kunde zunächst Nacherfüllung verlangen.</p>
                </div>
              </div>
              
              <!-- § 9 Haftung -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 9 Haftung</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Haftungsumfang: Mayer Elektro- und Gebäudetechnik GmbH, ihre gesetzlichen Vertreter und Erfüllungsgehilfen haften dem Kunden in Fällen des Vorsatzes oder der groben Fahrlässigkeit unbegrenzt nach den gesetzlichen Bestimmungen. Bei einfach fahrlässiger Verletzung einer wesentlichen Vertragspflicht (Kardinalpflicht) haftet Mayer Elektro- und Gebäudetechnik GmbH – außer in den Fällen der Verletzung von Leben, Körper oder Gesundheit – beschränkt auf den vertragstypischen, vorhersehbaren Schaden.</p>
                  <p>(2) Haftungsausschlüsse: Im Übrigen ist die Haftung von Mayer Elektro- und Gebäudetechnik GmbH für einfache Fahrlässigkeit ausgeschlossen. Dies gilt insbesondere für mittelbare Schäden und Folgeschäden, wie entgangenen Gewinn, Betriebsunterbrechungsschäden oder ausgebliebene Einsparungen.</p>
                </div>
              </div>
              
              <!-- § 10 Datenschutz -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 10 Datenschutz</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Mayer Elektro- und Gebäudetechnik GmbH erhebt, verarbeitet und nutzt personenbezogene Daten des Kunden (wie Name, Kontaktdaten, Auftragsdetails) zur Erfüllung der vertraglichen Pflichten und zur Geschäftsabwicklung. Diese Datenverarbeitung erfolgt unter Beachtung der geltenden Datenschutzgesetze, insbesondere der EU-Datenschutzgrundverordnung (DSGVO) und des Bundesdatenschutzgesetzes (BDSG). Alle personenbezogenen Daten werden vertraulich behandelt.</p>
                  <p>(2) Der Kunde willigt ein, dass Mayer Elektro- und Gebäudetechnik GmbH die erforderlichen personenbezogenen Daten für die Vertragsdurchführung speichert und nutzt. Diese Einwilligung kann der Kunde jederzeit mit Wirkung für die Zukunft widerrufen.</p>
                </div>
              </div>
              
              <!-- § 11 Schlussbestimmungen -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">§ 11 Schlussbestimmungen</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>(1) Es gilt das Recht der Bundesrepublik Deutschland unter Ausschluss des UN-Kaufrechts (CISG).</p>
                  <p>(2) Ist der Kunde Kaufmann im Sinne des Handelsgesetzbuches (HGB), eine juristische Person des öffentlichen Rechts oder ein öffentlich-rechtliches Sondervermögen, so ist ausschließlicher Gerichtsstand für alle Streitigkeiten aus und im Zusammenhang mit dem Vertragsverhältnis der Sitz von Mayer Elektro- und Gebäudetechnik GmbH (Deutschland).</p>
                  <p>(3) Information zur Online-Streitbeilegung gemäß Art. 14 Abs.1 ODR-Verordnung: Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit. Diese ist über folgenden Link erreichbar: <a href="https://ec.europa.eu/consumers/odr/" target="_blank" class="text-[#0097b2] hover:underline">
                    <span class="hidden sm:inline">https://ec.europa.eu/consumers/odr/</span>
                    <span class="sm:hidden">EU-ODR-Plattform</span>
                  </a></p>
                  <p>(4) Sollten einzelne Bestimmungen dieses Vertrages oder dieser AGB ganz oder teilweise unwirksam oder nichtig sein oder werden, so wird dadurch die Gültigkeit der übrigen Bestimmungen nicht berührt.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Kontakt -->
          <section class="border-t border-gray-200 dark:border-gray-700 pt-8">
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Fragen zu unseren AGB?</h3>
              <p class="text-gray-700 dark:text-gray-300 mb-4">Wenn Sie Fragen zu unseren Allgemeinen Geschäftsbedingungen haben, kontaktieren Sie uns gerne. Wir stehen Ihnen für weitere Informationen zur Verfügung.</p>
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