<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<style type="text/css">
	.orbis_patient_name { text-decoration: underline; }
</style>

<h1>Consentement et décharge</h1>

<p>Le « Soussigné » désigne le patient, à condition que le patient ait 18 ans ou plus, ou le tuteur légal du patient. La contraction de ce formulaire de Consentement et de décharge (« Décharge ») est facultative et n’empêchera pas le patient de recevoir de traitement médical du Projet ORBIS International, Inc., ainsi que de ses affiliés, filiales et succursales (collectivement, « ORBIS »). Le soussigné a le droit de demander à tout moment l’arrêt de la production d’enregistrements, de films et autres, et ORBIS accepte de prendre les mesures nécessaires pour respecter cette demande d’arrêt.</p>
<p>Moyennant une contrepartie valable dont il accuse réception dans la présente, le Soussigné accepte d’être interrogé, photographié, filmé ou enregistré en rapport avec un programme d’ORBIS, notamment pendant toute opération et procédure médicale, et accepte la reproduction de ce qui précède par tous les moyens, y compris, mais sans s’y limiter, la diffusion écrite, télédiffusée, radiodiffusée ou sur Internet, au format multimédia, vidéo ou audio (collectivement, les « Publications sur le Patient »).</p>
<p>Le Soussigné renonce à tous les droits, titres et intérêts dans les Publications sur le Patient et les accorde à ORBIS, en exemption de redevances. Le Soussigné consent à l’utilisation des Publications sur le Patient de toute manière utile pour l’évolution ou la diffusion des connaissances médicales, pour l’information ou l’enseignement, pour la sensibilisation et la promotion d’ORBIS, y compris, mais sans s’y limiter, le droit de donner, de vendre, de transférer, d’afficher et d’exposer les Publications sur le Patient ou des copies de celles-ci et de les faire circuler de toute manière possible. Le Soussigné renonce au droit d’examiner, d’approuver ou de modifier ces Publications sur le Patient et tout autre document descriptif ou publicitaire utilisé en relation avec celles-ci.</p>
<p>Le Soussigné décharge, dégage de toute responsabilité et accepte de tenir à couvert ORBIS, ses administrateurs, directeurs, employés, représentants, agents, cessionnaires et tout autre personne ou corporation agissant sous la permission et l’autorité d’ORBIS, y compris toute entreprise publiant et/ou distribuant les Publications sur le Patient, pour toute responsabilité résultant de toute utilisation des Publications sur le Patient et de toute distorsion, de tout estompage ou de toute altération, ou de l’utilisation sous une composite, de manière intentionnelle ou non, pouvant survenir ou être produite lors de l’obtention, du traitement, de la reproduction, de la distribution, de la diffusion ou de l’utilisation des Publications sur le Patient, même si ces dernières créent tout type de perception négative du Patient.</p>
<p>Cette Décharge est réalisée en mon nom propre et au nom de mes dépendants, héritiers, exécuteurs, administrateurs et cessionnaires, et est régie par les lois de l’État de New York. Le Soussigné représente et certifie par la présente qu’il a lu ce qui précède et qu’il en comprend entièrement la signification et l’effet, et avec l’intention d’être lié par la loi, il signe cette Décharge en ce <?php echo date('jS')?> du mois de <?php date('F Y')?>.</p>

<table>
	<thead>
		<tr><th></th><th></th></tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<p>
					__________________________<br/>
					Signature du Patient ou du Tuteur
				</p>
			</td>
			<td>
				<p>
					<span class="orbis_patient_name"><?php echo $patient->fullName?></span><br/>
					Nom en majuscules
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					__________________________<br/>
					Empreinte du pouce si nécessaire
				</p>
			</td>
		</tr>
	</tbody>
</table>
